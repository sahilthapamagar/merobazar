<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;

// use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
            $sellercount = Seller::count();
        })
            ->inRandomOrder()
            ->get();
        $sellercount = Seller::count();

        return view('frontend.home', compact('categories', 'products', 'sellercount'));
    }

    public function categories()
    {
        $categories = Category::withCount([
            'products' => function ($q) {
                $q->whereHas('seller', fn($s) => $s->where('status', 'active'));
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

        $products = $query->latest()->paginate(20);
        $categories = Category::withCount('products')->get();

        return view('frontend.products', compact('products', 'categories'));
    }

    public function product($id)
    {
        $product = Product::with('seller')->findOrFail($id);

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->when($product->category_id, function ($query) use ($product) {
                return $query->where('category_id', $product->category_id);
            })
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
