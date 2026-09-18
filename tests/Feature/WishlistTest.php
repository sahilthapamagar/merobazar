<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    // Product and Category use mass assignment without $fillable in this project.
    Model::unguard();
});

function wishlistProduct(): Product
{
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    return Product::create([
        'name' => 'Silk Scarf',
        'title' => 'Silk Scarf Title',
        'description' => 'A soft silk scarf.',
        'price' => 1500,
        'main_image' => 'products/images/scarf.jpg',
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ]);
}

it('requires authentication to open the wishlist page', function () {
    get(route('wishlist.index'))->assertRedirect(route('login'));
});

it('adds a product to the wishlist', function () {
    $user = User::factory()->create();
    $product = wishlistProduct();

    actingAs($user)->post(route('wishlist.toggle', $product->id));

    expect(Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->exists())->toBeTrue();
});

it('toggles a product off the wishlist when already saved', function () {
    $user = User::factory()->create();
    $product = wishlistProduct();

    Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]);

    actingAs($user)->post(route('wishlist.toggle', $product->id));

    expect(Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->exists())->toBeFalse();
});

it('refuses duplicate wishlist entries for the same user and product', function () {
    $user = User::factory()->create();
    $product = wishlistProduct();

    Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]);

    expect(fn () => Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]))
        ->toThrow(QueryException::class);
});

it('lists the saved products on the wishlist page', function () {
    $user = User::factory()->create();
    $product = wishlistProduct();

    Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]);

    actingAs($user)->get(route('wishlist.index'))
        ->assertOk()
        ->assertSee('Silk Scarf');
});

it('does not show one users wishlist entries to another user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $product = wishlistProduct();

    Wishlist::create(['user_id' => $owner->id, 'product_id' => $product->id]);

    actingAs($other)->get(route('wishlist.index'))
        ->assertOk()
        ->assertDontSee('Silk Scarf');
});

it('allows removing an owned wishlist entry', function () {
    $user = User::factory()->create();
    $product = wishlistProduct();

    $wishlist = Wishlist::create(['user_id' => $user->id, 'product_id' => $product->id]);

    actingAs($user)->delete(route('wishlist.destroy', $wishlist->id));

    expect(Wishlist::find($wishlist->id))->toBeNull();
});

it('forbids removing a wishlist entry owned by someone else', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $product = wishlistProduct();

    $wishlist = Wishlist::create(['user_id' => $owner->id, 'product_id' => $product->id]);

    actingAs($other)->delete(route('wishlist.destroy', $wishlist->id))->assertForbidden();

    expect(Wishlist::find($wishlist->id))->not->toBeNull();
});
