<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::guard('web')->user();

        $cartItems = Cart::with(['product', 'seller'])
            ->when($user, function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }, function ($query) {
                $query->where(function ($q) {
                    if (session()->has('guest_cart_session_id')) {
                        $q->where('user_id', null)
                            ->where('guest_session_id', session('guest_cart_session_id'));
                    } else {
                        $sessionId = Str::uuid()->toString();
                        session(['guest_cart_session_id' => $sessionId]);
                        $q->where('user_id', null)
                            ->where('guest_session_id', $sessionId);
                    }
                });
            })
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
