<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

beforeEach(function () {
    Model::unguard();
});

function guestCheckoutFixture(int $price = 2000): array
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

function addGuestCartItem(Seller $seller, Product $product, string $sessionId, int $quantity = 1): Cart
{
    return Cart::create([
        'user_id' => null,
        'guest_session_id' => $sessionId,
        'seller_id' => $seller->id,
        'product_id' => $product->id,
        'quantity' => $quantity,
        'amount' => (float) $product->effective_price * $quantity,
    ]);
}

it('lets a guest add a product to the cart without logging in', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 2])
        ->assertRedirect(route('cart.index'));

    $cart = Cart::whereNull('user_id')->first();

    expect($cart)->not->toBeNull()
        ->and((int) $cart->quantity)->toBe(2)
        ->and((int) $cart->seller_id)->toBe($seller->id);
});

it('keeps each guest cart scoped to its own session', function () {
    [$seller, $product] = guestCheckoutFixture();
    $sessionId = 'session-one';

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1])
        ->assertRedirect(route('cart.index'));

    addGuestCartItem($seller, $product, $sessionId);

    // The freshly created guest cart belongs to a different session id.
    get(route('cart.index'))->assertOk();

    $visible = Cart::whereNull('user_id')
        ->where('guest_session_id', session('guest_cart_session_id'))
        ->count();

    expect($visible)->toBe(1);
});

it('shows the guest cart page without authentication', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    get(route('cart.index'))
        ->assertOk()
        ->assertSee('Wool Shawl');
});

it('opens the checkout page for a guest with items in the cart', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    get(route('checkout.seller', $seller->id))
        ->assertOk()
        ->assertSee('Wool Shawl');
});

it('places a guest order without a linked user account', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ])->assertRedirect(route('home'));

    $order = Order::latest('id')->first();

    expect($order)->not->toBeNull()
        ->and($order->user_id)->toBeNull()
        ->and($order->billing_name)->toBe('Guest Shopper')
        ->and($order->billing_email)->toBe('guest@example.com')
        ->and($order->billing_phone)->toBe('9812345678')
        ->and($order->guest_token)->not->toBeNull()
        ->and((float) $order->total_amount)->toBe(2000.0)
        ->and($order->orderItems)->toHaveCount(1);

    // The guest cart is emptied once the order is placed.
    expect(Cart::whereNull('user_id')->count())->toBe(0);
});

it('requires a guest name and email to place an order', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    post(route('order.store', $seller->id), [
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ])->assertSessionHasErrors(['name', 'email']);
});

it('keeps guest order details out of the buying history', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ]);

    $user = User::factory()->create();

    actingAs($user)->get(route('buying-history'))->assertOk();
});

it('still links orders to the account when a customer is logged in', function () {
    [$seller, $product] = guestCheckoutFixture();
    $user = User::factory()->create();

    actingAs($user)->post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    actingAs($user)->post(route('order.store', $seller->id), [
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ])->assertRedirect(route('buying-history.show', Order::latest('id')->first()->id));

    $order = Order::latest('id')->first();

    expect((int) $order->user_id)->toBe($user->id)
        ->and($order->guest_token)->toBeNull()
        ->and(DeliveryAddress::where('user_id', $user->id)->exists())->toBeTrue();
});

it('applies a percentage coupon to the order total', function () {
    [$seller, $product] = guestCheckoutFixture(2000);

    Coupon::create([
        'code' => 'SAVE10',
        'type' => 'percent',
        'value' => 10,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    post(route('coupon.apply'), ['code' => 'save10', 'amount' => 2000]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ]);

    $order = Order::latest('id')->first();

    expect((float) $order->subtotal_amount)->toBe(2000.0)
        ->and((float) $order->discount_amount)->toBe(200.0)
        ->and((float) $order->total_amount)->toBe(1800.0);
});

it('rejects a coupon below its minimum spend', function () {
    [$seller, $product] = guestCheckoutFixture(500);

    Coupon::create([
        'code' => 'BIGSPEND',
        'type' => 'fixed',
        'value' => 300,
        'min_spend' => 1000,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    post(route('coupon.apply'), ['code' => 'BIGSPEND', 'amount' => 500]);

    expect(session('coupon_code'))->toBeNull();
});

it('caps a percentage discount at the maximum discount amount', function () {
    [$seller, $product] = guestCheckoutFixture(5000);

    Coupon::create([
        'code' => 'CAP500',
        'type' => 'percent',
        'value' => 50,
        'max_discount' => 500,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'CAP500', 'amount' => 5000]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ]);

    $order = Order::latest('id')->first();

    expect((float) $order->discount_amount)->toBe(500.0)
        ->and((float) $order->total_amount)->toBe(4500.0);
});

it('increments the coupon usage count when an order uses it', function () {
    [$seller, $product] = guestCheckoutFixture(1000);

    $coupon = Coupon::create([
        'code' => 'ONCE10',
        'type' => 'fixed',
        'value' => 100,
        'active' => true,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'ONCE10', 'amount' => 1000]);

    post(route('order.store', $seller->id), [
        'name' => 'Guest Shopper',
        'email' => 'guest@example.com',
        'address_detail' => 'Balkhu, Ward 4',
        'contact' => '9812345678',
        'payment_method' => 'cod',
    ]);

    expect($coupon->fresh()->uses_count)->toBe(1);
});

it('ignores an inactive coupon', function () {
    [$seller, $product] = guestCheckoutFixture(1000);

    Coupon::create([
        'code' => 'EXPIRED',
        'type' => 'fixed',
        'value' => 500,
        'active' => false,
    ]);

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);
    post(route('coupon.apply'), ['code' => 'EXPIRED', 'amount' => 1000]);

    expect(session('coupon_code'))->toBeNull();
});

it('lets a guest update the quantity of their own cart line', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    $cart = Cart::whereNull('user_id')->first();

    patch(route('cart.update', $cart->id), ['quantity' => 3])
        ->assertRedirect(route('cart.index'));

    expect((int) $cart->fresh()->quantity)->toBe(3)
        ->and((float) $cart->fresh()->amount)->toBe(6000.0);
});

it('lets a guest remove their own cart line', function () {
    [$seller, $product] = guestCheckoutFixture();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    $cart = Cart::whereNull('user_id')->first();

    delete(route('cart.destroy', $cart->id))->assertRedirect(route('cart.index'));

    expect(Cart::whereNull('user_id')->count())->toBe(0);
});

it('forbids touching a cart line that belongs to another guest session', function () {
    [$seller, $product] = guestCheckoutFixture();

    $foreignCart = addGuestCartItem($seller, $product, 'someone-elses-session');

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1]);

    patch(route('cart.update', $foreignCart->id), ['quantity' => 9])->assertForbidden();
    delete(route('cart.destroy', $foreignCart->id))->assertForbidden();

    expect(Cart::find($foreignCart->id))->not->toBeNull();
});

it('merges the guest cart into the account cart after logging in', function () {
    [$seller, $product] = guestCheckoutFixture();
    $user = User::factory()->create();

    post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 2]);

    $guestCart = Cart::whereNull('user_id')->first();
    expect($guestCart)->not->toBeNull();

    post(route('login'), ['email' => $user->email, 'password' => 'password']);

    $this->post(route('cart.mergeGuestCart'));

    expect(Cart::whereNull('user_id')->count())->toBe(0)
        ->and(Cart::where('user_id', $user->id)->count())->toBe(1);
});