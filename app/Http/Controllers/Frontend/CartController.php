<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if (! $user) {
            toast('Please login to view your cart!', 'error');

            return redirect()->route('login');
        }

        $cartItems = Cart::with(['product', 'seller'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $subtotal = $cartItems->sum('amount');

        $cartGroups = $cartItems->groupBy('seller_id')->map(function ($items) {
            return [
                'seller' => $items->first()->seller,
                'items' => $items->values(),
                'quantity' => $items->sum('quantity'),
                'subtotal' => $items->sum('amount'),
            ];
        })->values();

        return view('frontend.cart', compact('cartItems', 'cartGroups', 'subtotal'));
    }

    public function destroy(Request $request, Cart $cart): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if (! $user || $cart->user_id !== $user->id) {
            abort(403);
        }

        $cart->delete();

        toast('Item removed from cart.', 'success');

        return redirect()->route('cart.index');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if (! $user || $cart->user_id !== $user->id) {
            abort(403);
        }

        $product = $cart->product;

        if (! $product) {
            $cart->delete();
            toast('This product is no longer available.', 'error');

            return redirect()->route('cart.index');
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $quantity = (int) $validated['quantity'];

        $cart->quantity = $quantity;
        $cart->amount = $product->effective_price * $quantity;
        $cart->save();

        toast('Cart quantity updated.', 'success');

        return redirect()->route('cart.index');
    }
}
