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

        $cartItems = Cart::with(['product', 'productVarient'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $subtotal = $cartItems->sum('amount');

        return view('frontend.cart', compact('cartItems', 'subtotal'));
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
}
