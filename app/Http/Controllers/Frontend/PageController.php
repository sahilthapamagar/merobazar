<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

// use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::with('productVarient')->whereStock(true)->limit(4)->get();

        return view('frontend.home', compact('products'));
    }

    public function products()
    {
        $products = Product::with('productVarient')->whereStock(true)->latest()->get();

        return view('frontend.products', compact('products'));
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

        // If not enough related products by category, get latest products
        if ($relatedProducts->count() < 4) {
            $additionalProducts = Product::with('productVarient')
                ->where('stock', true)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->latest()
                ->take(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->concat($additionalProducts);
        }

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
