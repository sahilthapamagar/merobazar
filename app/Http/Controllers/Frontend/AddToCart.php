<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Controller
{
    public function addtocart(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::with('seller')->findOrFail($request->input('product_id'));
        $seller = $product->seller;
        $user = Auth::guard('web')->user();

        if (! $user) {
            toast('Please login to add products to cart!', 'error');

            return redirect()->route('login');
        }

        if (! $seller) {
            toast('This product is no longer available!', 'error');

            return redirect()->back();
        }

        if ($seller->status !== 'active') {
            toast('This product is no longer available!', 'error');

            return redirect()->back();
        }

        $quantity = (int) $request->input('quantity', 1);

        // Find an existing cart entry for this user + product, or create a new one
        $cart = Cart::firstOrNew([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        // If it already exists, accumulate the quantity; otherwise set seller_id for the new row
        if ($cart->exists) {
            $cart->quantity += $quantity;
        } else {
            $cart->seller_id = $seller->id;
            $cart->quantity  = $quantity;
        }

        $cart->amount = $product->effective_price * $cart->quantity;
        $cart->save();

        toast('Product added to cart successfully!', 'success');

        return redirect()->route('cart.index')->with('cart_added', true);
    }
}
