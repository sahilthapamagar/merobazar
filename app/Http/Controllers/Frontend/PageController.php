<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Product;
use App\Models\Seller;

class PageController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->with(['products' => function ($query) {
                $query->withAvg('reviews', 'rating')->withCount('reviews')->latest()->take(4);
            }])
            ->get();

        $products = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
        })
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->inRandomOrder()
            ->get();

        // ⚡ Approved & Active Flash Sales (strictly within time window and with stock left)
        $activeFlashSales = FlashSale::active()
            ->whereHas('product.seller', fn ($s) => $s->where('status', 'active'))
            ->with(['product.seller', 'product.category', 'product' => fn ($q) => $q->withAvg('reviews', 'rating')->withCount('reviews')])
            ->orderBy('end_time', 'asc')
            ->get();

        // ⚡ Fallback fresh drops if no active flash sales exist
        $flashProducts = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
        })
            ->with(['seller', 'category'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->take(8)
            ->get();

        $latestFlashDrop = $activeFlashSales->isNotEmpty()
            ? $activeFlashSales->first()->product
            : $flashProducts->first();

        // 🌟 Hero Carousel: Products with active flash sales or latest fresh uploads
        $heroSlides = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
        })
            ->with(['seller', 'category'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest('created_at')
            ->take(8)
            ->get();

        $sellercount = Seller::count();

        return view('frontend.home', compact('categories', 'products', 'flashProducts', 'latestFlashDrop', 'sellercount', 'heroSlides', 'activeFlashSales'));
    }

    public function categories()
    {
        $categories = Category::withCount([
            'products' => function ($q) {
                $q->whereHas('seller', fn ($s) => $s->where('status', 'active'));
            },
        ])->get();

        $totalProducts = Product::whereHas('seller', function ($q) {
            $q->where('status', 'active');
        })->count();

        return view('frontend.category', compact('categories', 'totalProducts'));
    }

    public function products()
    {
        $query = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
        });

        // Filter by category if specified
        if ($categorySlug = request('category')) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Free-text search: every term must match the product name/title/description,
        // the category name, or the seller's shop name.
        if ($search = trim((string) request('search'))) {
            foreach (preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY) as $term) {
                $like = '%'.$term.'%';

                $query->where(function ($q) use ($like) {
                    $q->where('name', 'like', $like)
                        ->orWhere('title', 'like', $like)
                        ->orWhere('description', 'like', $like)
                        ->orWhereHas('category', fn ($c) => $c->where('name', 'like', $like))
                        ->orWhereHas('seller', fn ($s) => $s->where('shop_name', 'like', $like));
                });
            }
        }

        // Price-range filter uses the effective price (discounted price when lower, else regular price).
        // Values are validated with is_numeric() and inlined so the comparison stays numeric
        // regardless of the database driver (a bound string breaks CASE comparisons on SQLite).
        $effectivePrice = 'CASE WHEN discounted_price IS NOT NULL AND discounted_price > 0 AND discounted_price < price'
            .' THEN discounted_price ELSE price END';

        if (is_numeric(request('min_price'))) {
            $query->whereRaw($effectivePrice.' >= '.(float) request('min_price'));
        }

        if (is_numeric(request('max_price'))) {
            $query->whereRaw($effectivePrice.' <= '.(float) request('max_price'));
        }

        // Sorting (whitelisted keys; default = newest first)
        match (request('sort')) {
            'price_asc' => $query->orderByRaw($effectivePrice.' ASC'),
            'price_desc' => $query->orderByRaw($effectivePrice.' DESC'),
            'rating' => $query->orderByRaw('reviews_avg_rating DESC, reviews_count DESC'),
            'name' => $query->orderBy('name'),
            default => $query->latest(),
        };

        $products = $query
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate(20)
            ->withQueryString();

        $categories = Category::withCount('products')->get();

        return view('frontend.products', compact('products', 'categories'));
    }

    public function ourStory()
    {
        return view('frontend.our-story');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function flashSales()
    {
        $activeFlashSales = FlashSale::active()
            ->whereHas('product.seller', fn ($s) => $s->where('status', 'active'))
            ->with(['product.seller', 'product.category', 'product' => fn ($q) => $q->withAvg('reviews', 'rating')->withCount('reviews')])
            ->orderBy('end_time', 'asc')
            ->get();

        $earliestEnd = $activeFlashSales->min('end_time');

        return view('frontend.flash-sales', compact('activeFlashSales', 'earliestEnd'));
    }

    public function product($id)
    {
        $product = Product::with([
            'seller',
            'flashSales' => fn ($q) => $q->active(),
            'reviews' => fn ($q) => $q->with('user')->latest(),
        ])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->findOrFail($id);

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->when($product->category_id, function ($query) use ($product) {
                return $query->where('category_id', $product->category_id);
            })
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->take(6)
            ->inRandomOrder()
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
