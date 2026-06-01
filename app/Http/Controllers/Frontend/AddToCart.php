<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Controller
{
    public function addtocart(Request $request)
    {
        $request->validate([
            'product_varient_id' => ['required', 'exists:product_varients,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $variant = ProductVarient::findOrFail($request->input('product_varient_id'));
        $product = $variant->product;
        $seller = $product->seller;
        $user = Auth::guard('web')->user();

        if (! $user) {
            toast('Please login to add products to cart!', 'error');

            return redirect()->back();
        }

        $quantity = (int) $request->input('quantity', 1);
        $unitPrice = (float) $variant->price;

        if ($product->discount > 0) {
            $unitPrice -= $unitPrice * ((float) $product->discount / 100);
        }

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->seller_id = $seller->id;
        $cart->product_id = $product->id;
        $cart->product_varient_id = $variant->id;
        $cart->quantity = $quantity;
        $cart->amount = round($unitPrice * $quantity, 2);
        $cart->save();

        toast('Product added to cart successfully!', 'success');

        return redirect()->route('cart.index')->with('cart_added', true);
    }
}
