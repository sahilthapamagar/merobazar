<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Support\GuestCartSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(function () {
    Model::unguard();
});

function shopFixture(float $price = 2000): array
{
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    $product = Product::create([
        'name' => 'Wool Shawl',
        'title' => 'Wool Shawl Title',
        'description' => 'A warm wool shawl.',
        'price' => $price,
        'main_image' => 'products/images/shawl.jpg',
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ]);

    return [$seller, $product];
}

function addGuestLine(Product $product, int $quantity = 1): void
{
    $sessionId = GuestCartSession::id(create: true);

    Cart::create([
        'user_id' => null,
        'guest_session_id' => $sessionId,
        'seller_id' => $product->seller_id,
        'product_id' => $product->id,
        'quantity' => $quantity,
        'amount' => $product->price * $quantity,
    ]);
}

it('reports an empty cart without querying for a guest who never added one', function () {
    expect(session()->has('guest_cart_session_id'))->toBeFalse()
        ->and(GuestCartSession::itemCount())->toBe(0);

    // A guest with no cart key must not get one just by looking at the navbar.
    expect(session()->has('guest_cart_session_id'))->toBeFalse();
});

it('counts a guest cart once the guest has added something', function () {
    [, $product] = shopFixture();

    addGuestLine($product);

    expect(GuestCartSession::itemCount())->toBe(1);
});

it('never counts a guest cart belonging to a different session', function () {
    [, $product] = shopFixture();

    addGuestLine($product);

    // Simulate a brand new visitor sharing no session state with the one above.
    session()->forget('guest_cart_session_id');

    expect(GuestCartSession::itemCount())->toBe(0);
});

it('carries the guest cart over when the shopper logs in', function () {
    [$seller, $product] = shopFixture();

    addGuestLine($product, 2);

    $user = User::factory()->create();

    // Auth::login fires the Login event, which is what triggers the merge.
    Auth::login($user);

    expect(Cart::where('user_id', $user->id)->count())->toBe(1);

    $line = Cart::where('user_id', $user->id)->first();

    expect($line->quantity)->toBe(2)
        ->and($line->guest_session_id)->toBeNull();

    expect(Cart::whereNull('user_id')->count())->toBe(0);
    expect(session()->has('guest_cart_session_id'))->toBeFalse();
});

it('combines quantities when logging in with a matching product already in the cart', function () {
    [, $product] = shopFixture();

    $user = User::factory()->create();

    Cart::create([
        'user_id' => $user->id,
        'guest_session_id' => null,
        'seller_id' => $product->seller_id,
        'product_id' => $product->id,
        'quantity' => 3,
        'amount' => $product->price * 3,
    ]);

    addGuestLine($product, 2);

    Auth::login($user);

    $lines = Cart::where('user_id', $user->id)->get();

    expect($lines)->toHaveCount(1)
        ->and($lines->first()->quantity)->toBe(5)
        ->and((float) $lines->first()->amount)->toBe((float) ($product->price * 5))
        ->and(Cart::whereNull('user_id')->count())->toBe(0);
});

it('shows a guest the products page rather than erroring when the cart is empty', function () {
    $response = get('/products?search=shoes');

    $response->assertOk();
});

it('spends a coupon on a cash on delivery order', function () {
    [$seller, $product] = shopFixture();

    $coupon = Coupon::create([
        'code' => 'SAVE10',
        'type' => 'percent',
        'value' => 10,
        'min_spend' => 100,
        'max_uses' => 10,
        'uses_count' => 0,
        'per_user_limit' => null,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'save10', 'amount' => 2000]);

    $response = post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'contact' => '9812345678',
        'address_detail' => 'Balkhu, Ward 4',
        'payment_method' => 'cod',
    ]);

    $response->assertRedirect();

    expect($coupon->fresh()->uses_count)->toBe(1);
});

it('does not spend a coupon when a Khalti checkout is abandoned', function () {
    Http::fake(['dev.khalti.com/*' => Http::response([], 500)]);

    [$seller, $product] = shopFixture();

    $coupon = Coupon::create([
        'code' => 'SAVE20',
        'type' => 'percent',
        'value' => 20,
        'min_spend' => 100,
        'max_uses' => 10,
        'uses_count' => 0,
        'per_user_limit' => null,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'save20', 'amount' => 2000]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'contact' => '9812345678',
        'address_detail' => 'Balkhu, Ward 4',
        'payment_method' => 'khalti',
    ]);

    $order = Order::latest('id')->first();

    // Creating an unpaid Khalti order must not consume the coupon.
    expect($coupon->fresh()->uses_count)->toBe(0);

    // The shopper abandons the payment.
    get(route('khalti.callback', $order->id).'?Status=Cancelled');

    expect($coupon->fresh()->uses_count)->toBe(0)
        ->and($order->fresh()->status)->toBe('cancelled');
});

it('spends a coupon once the Khalti payment completes', function () {
    Http::fake(['dev.khalti.com/*' => Http::response([], 500)]);

    [$seller, $product] = shopFixture();

    $coupon = Coupon::create([
        'code' => 'SAVE30',
        'type' => 'percent',
        'value' => 30,
        'min_spend' => 100,
        'max_uses' => 10,
        'uses_count' => 0,
        'per_user_limit' => null,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'save30', 'amount' => 2000]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'contact' => '9812345678',
        'address_detail' => 'Balkhu, Ward 4',
        'payment_method' => 'khalti',
    ]);

    $order = Order::latest('id')->first();

    expect($coupon->fresh()->uses_count)->toBe(0);

    get(route('khalti.callback', $order->id).'?Status=Completed');

    expect($coupon->fresh()->uses_count)->toBe(1);
});

it('enforces the per user coupon limit', function () {
    [$seller, $product] = shopFixture();

    $coupon = Coupon::create([
        'code' => 'ONCEONLY',
        'type' => 'percent',
        'value' => 10,
        'min_spend' => 100,
        'max_uses' => null,
        'uses_count' => 0,
        'per_user_limit' => 1,
        'active' => true,
    ]);

    $user = User::factory()->create();

    expect($coupon->isValidFor(2000))->toBeTrue();

    Order::create([
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'status' => 'delivered',
        'payment_status' => 'completed',
        'total_amount' => 2000,
        'payment_method' => 'cod',
        'coupon_id' => $coupon->id,
    ]);

    Auth::login($user);

    expect($coupon->isValidFor(2000))->toBeFalse();
});
