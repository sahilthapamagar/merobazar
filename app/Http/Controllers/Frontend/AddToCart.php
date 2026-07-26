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
        $stock = (int) ($variant->stock ?? 0);

        if ($stock < 1) {
            toast('This product is out of stock!', 'error');

            return redirect()->back();
        }

        $quantity = min(max(1, $quantity), $stock);

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->seller_id = $seller->id;
        $cart->product_id = $product->id;
        $cart->product_varient_id = $variant->id;
        $cart->quantity = $quantity;
        $cart->amount = Cart::lineAmountFor($product, $variant, $quantity);
        $cart->save();

        toast('Product added to cart successfully!', 'success');

        return redirect()->route('cart.index')->with('cart_added', true);
    }
}
