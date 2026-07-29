<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

// use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::whereHas('seller', function ($query) {
            $query->where('status', 'active');
        })->inRandomOrder()->take(4)->get();

        return view('frontend.home', compact('categories', 'products'));
    }

    public function categories()
    {
        $categories = Category::withCount(['products' => function ($q) {
            $q->whereHas('seller', fn ($s) => $s->where('status', 'active'));
        }])->get();

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
        $product = Product::with(['productVarient', 'seller'])
            ->where('stock', true)
            ->findOrFail($id);

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::with('productVarient')
            ->where('stock', true)
            ->where('id', '!=', $product->id)
            ->when($product->category, function ($query) use ($product) {
                return $query->where('category', $product->category);
            })
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
