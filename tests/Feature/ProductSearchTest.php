<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\get;

beforeEach(function () {
    // Product and Category use mass assignment without $fillable in this project.
    Model::unguard();
});

function createProduct(Seller $seller, Category $category, array $attributes = []): Product
{
    return Product::create(array_merge([
        'name' => 'Test Product',
        'title' => 'Test Product Title',
        'description' => 'A lovely test product description.',
        'price' => 1000,
        'main_image' => 'products/images/test.jpg',
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ], $attributes));
}

function createReview(Product $product, int $rating): void
{
    $user = User::factory()->create();

    $order = Order::create([
        'user_id' => $user->id,
        'seller_id' => $product->seller_id,
        'status' => 'delivered',
        'payment_status' => 'paid',
        'total_amount' => $product->price,
        'payment_method' => 'cod',
    ]);

    $orderItem = OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 1,
        'amount' => $product->price,
    ]);

    Review::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'order_item_id' => $orderItem->id,
        'rating' => $rating,
        'comment' => 'Nice product.',
    ]);
}

it('lists products matching the search term by name', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Red Silk Saree']);
    createProduct($seller, $category, ['name' => 'Leather Wallet']);

    get(route('products', ['search' => 'saree']))
        ->assertOk()
        ->assertSee('Red Silk Saree')
        ->assertDontSee('Leather Wallet');
});

it('matches search terms against category names and shop names', function () {
    $seller = Seller::factory()->create(['status' => 'active', 'shop_name' => 'Himalayan Crafts']);
    $category = Category::create(['name' => 'Footwear', 'slug' => 'footwear']);

    createProduct($seller, $category, ['name' => 'Running Sneakers']);
    createProduct($seller, $category, ['name' => 'Canvas Bag']);

    // Category name match.
    get(route('products', ['search' => 'footwear']))
        ->assertOk()
        ->assertSee('Running Sneakers')
        ->assertSee('Canvas Bag');

    // Shop name match.
    get(route('products', ['search' => 'himalayan']))
        ->assertOk()
        ->assertSee('Running Sneakers')
        ->assertSee('Canvas Bag');
});

it('requires every search term to match', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Womens Wear', 'slug' => 'womens-wear']);

    createProduct($seller, $category, ['name' => 'Red Silk Saree']);
    createProduct($seller, $category, ['name' => 'Blue Cotton Shawl']);
    createProduct($seller, $category, ['name' => 'Silk Shawl']);

    get(route('products', ['search' => 'red silk']))
        ->assertOk()
        ->assertSee('Red Silk Saree')
        ->assertDontSee('Blue Cotton Shawl')
        ->assertDontSee('Silk Shawl');
});

it('searches the product description too', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Mystery Box', 'description' => 'Handcrafted by Newar artisans of Bhaktapur.']);
    createProduct($seller, $category, ['name' => 'Plain Item']);

    get(route('products', ['search' => 'bhaktapur']))
        ->assertOk()
        ->assertSee('Mystery Box')
        ->assertDontSee('Plain Item');
});

it('filters by price range using the discounted price when available', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    // Effective prices: 500 / 300 (discounted) / 2000.
    createProduct($seller, $category, ['name' => 'Cheap Item', 'price' => 500]);
    createProduct($seller, $category, ['name' => 'Deal Item', 'price' => 1000, 'discounted_price' => 300]);
    createProduct($seller, $category, ['name' => 'Luxe Item', 'price' => 2000]);

    get(route('products', ['min_price' => 450, 'max_price' => 600]))
        ->assertOk()
        ->assertSee('Cheap Item')
        ->assertDontSee('Deal Item')
        ->assertDontSee('Luxe Item');
});

it('sorts by price low to high using the effective price', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    // Effective prices: 500 / 300 (discounted) / 2000 → Deal, Cheap, Luxe.
    createProduct($seller, $category, ['name' => 'Cheap Item', 'price' => 500]);
    createProduct($seller, $category, ['name' => 'Deal Item', 'price' => 1000, 'discounted_price' => 300]);
    createProduct($seller, $category, ['name' => 'Luxe Item', 'price' => 2000]);

    get(route('products', ['sort' => 'price_asc']))
        ->assertOk()
        ->assertSeeInOrder(['Deal Item', 'Cheap Item', 'Luxe Item']);
});

it('sorts by price high to low', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Cheap Item', 'price' => 500]);
    createProduct($seller, $category, ['name' => 'Luxe Item', 'price' => 2000]);

    get(route('products', ['sort' => 'price_desc']))
        ->assertOk()
        ->assertSeeInOrder(['Luxe Item', 'Cheap Item']);
});

it('sorts by rating with unrated products last', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    $top = createProduct($seller, $category, ['name' => 'Top Item']);
    $low = createProduct($seller, $category, ['name' => 'Low Item']);
    $plain = createProduct($seller, $category, ['name' => 'Plain Item']);

    createReview($top, 5);
    createReview($low, 1);

    get(route('products', ['sort' => 'rating']))
        ->assertOk()
        ->assertSeeInOrder(['Top Item', 'Low Item', 'Plain Item']);
});

it('sorts alphabetically by name', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Zebra Toy']);
    createProduct($seller, $category, ['name' => 'Alpha Toy']);

    get(route('products', ['sort' => 'name']))
        ->assertOk()
        ->assertSeeInOrder(['Alpha Toy', 'Zebra Toy']);
});

it('shows a helpful message when nothing matches the search', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Real Item']);

    get(route('products', ['search' => 'nonexistent-xyz']))
        ->assertOk()
        ->assertDontSee('Real Item')
        ->assertSee('No products found for')
        ->assertSee('nonexistent-xyz')
        ->assertSee('Clear Search');
});

it('never lists products from inactive sellers', function () {
    $inactive = Seller::factory()->create(['status' => 'inactive']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($inactive, $category, ['name' => 'Hidden Gem']);

    get(route('products', ['search' => 'hidden gem']))
        ->assertOk()
        ->assertDontSee('Hidden Gem')
        ->assertSee('No products found for');
});

it('shows the search term in the page heading', function () {
    $seller = Seller::factory()->create(['status' => 'active']);
    $category = Category::create(['name' => 'Accessories', 'slug' => 'accessories']);

    createProduct($seller, $category, ['name' => 'Silk Scarf']);

    get(route('products', ['search' => 'silk scarf']))
        ->assertOk()
        ->assertSee('Results for')
        ->assertSee('silk scarf', false);
});
