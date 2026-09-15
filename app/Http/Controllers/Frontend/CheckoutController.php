<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacementMail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout($id)
    {
        $seller = Seller::findOrFail($id);
        $user = Auth::guard('web')->user();

        $carts = Cart::with('product')
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
            ->where('seller_id', $id)
            ->get();

        if ($carts->isEmpty()) {
            toast('Your cart is empty for this seller.', 'error');
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout', compact('seller', 'carts'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address_detail' => 'required|string|max:500',
            'contact' => 'required|string|max:15',
            'payment_method' => 'required|in:cod,khalti',
        ]);

        $seller = Seller::findOrFail($id);
        $user = Auth::guard('web')->user();

        $carts = Cart::with('product')
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
            ->where('seller_id', $id)
            ->get();

        if ($carts->isEmpty()) {
            toast('Your cart is empty for this seller.', 'error');

            return redirect()->route('cart.index');
        }

        // Save delivery address for logged in user
        if ($user) {
            if (! $user->deliveryAddresses) {
                $delivery_address = new DeliveryAddress;
                $delivery_address->user_id = $user->id;
                $delivery_address->address_detail = $request->address_detail;
                $delivery_address->contact = $request->contact;
                $delivery_address->save();
            } else {
                $delivery_address = $user->deliveryAddresses;
                $delivery_address->address_detail = $request->address_detail;
                $delivery_address->contact = $request->contact;
                $delivery_address->save();
            }
        }

        $subtotal = (float) $carts->sum('amount');
        $discount = 0.0;
        $coupon = null;

        if ($code = session('coupon_code')) {
            $coupon = Coupon::whereRaw('UPPER(code) = ?', [strtoupper($code)])->where('active', true)->first();
            $discount = $coupon?->discountFor($subtotal) ?? 0.0;

            if ($discount <= 0) {
                $coupon = null;
                session()->forget('coupon_code');
            }
        }

        $order = new Order;
        if ($user) {
            $order->user_id = $user->id;
        } else {
            $order->user_id = null;
            $order->billing_name = $request->name;
            $order->billing_email = $request->email;
            $order->billing_phone = $request->contact;
            $order->billing_address = $request->address_detail;
            $order->shipping_address = $request->address_detail;
            $order->guest_token = Str::uuid()->toString();
        }
        $order->seller_id = $seller->id;
        $order->subtotal_amount = $subtotal;
        $order->discount_amount = $discount;
        $order->total_amount = max(0, round($subtotal - $discount, 2));
        $order->payment_method = $request->payment_method;

        if ($coupon) {
            $order->coupon_id = $coupon->id;
        }

        $order->save();

        if ($coupon) {
            $coupon->increment('uses_count');
            session()->forget('coupon_code');
        }

        foreach ($carts as $cart) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;

            $orderItem->quantity = $cart->quantity;
            $orderItem->amount = $cart->amount;
            $orderItem->save();

            // If product is on active flash sale, track the sold quantity
            if ($cart->product && $cart->product->has_active_flash_sale) {
                $cart->product->active_flash_sale->increment('sold_quantity', (int) $cart->quantity);
            }

            $cart->delete();
        }

        if ($request->payment_method == 'cod') {
            try {
                if ($order->user && $order->user->email) {
                    Mail::to($order->user->email)->send(new OrderPlacementMail($order, 'Cash on Delivery'));
                } elseif ($order->billing_email) {
                    Mail::to($order->billing_email)->send(new OrderPlacementMail($order, 'Cash on Delivery'));
                }
            } catch (\Throwable $e) {
                Log::error('Order placement mail error: '.$e->getMessage());
            }

            toast('Order placed successfully! Thank you for your purchase.', 'success');

            if ($order->user) {
                return redirect()->route('buying-history.show', $order->id)->with('success', 'Order placed successfully! Thank you for your purchase.');
            }

            return redirect()->route('home')->with('success', 'Order placed successfully!');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Key '.$seller->khalti_secrect_key,
        ])->withoutVerifying()->post('https://dev.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('khalti.callback', ['id' => $order->id]),
            'website_url' => route('home'),
            'amount' => (int) ($order->total_amount * 100),
            'purchase_order_id' => (string) $order->id,
            'purchase_order_name' => 'Order #'.$order->id,
        ]);
        $data = $response->json();

        if (! $response->successful() || ! isset($data['payment_url'])) {
            Log::error('Khalti payment initiation failed', [
                'order_id' => $order->id,
                'response' => $data,
            ]);
            toast('Payment initiation failed. Please try again or choose Cash on Delivery.', 'error');

            return redirect()->route('checkout.seller', $seller->id);
        }

        return redirect($data['payment_url']);
    }

    public function khalti_callback(Request $request, $id)
    {
        // $id is now the order ID (passed correctly from store method)
        $order = Order::findOrFail($id);

        $status = $request->input('status', 'pending');
        $isSuccess = strtolower((string) $status) === 'completed';

        $order->payment_status = $status;

        // Payment was cancelled / expired / failed in Khalti: cancel the order so it
        // is never treated as a real order (hidden from Buying History & seller orders).
        if (! $isSuccess) {
            $order->status = 'cancelled';
        }

        $order->save();

        // Only confirm (email) the order once the Khalti payment is completed.
        if ($isSuccess) {
            try {
                if ($order->user && $order->user->email) {
                    Mail::to($order->user->email)->send(new OrderPlacementMail($order, 'Khalti'));
                } elseif ($order->billing_email) {
                    Mail::to($order->billing_email)->send(new OrderPlacementMail($order, 'Khalti'));
                }
            } catch (\Throwable $e) {
                Log::error('Khalti order mail error: '.$e->getMessage());
            }
        }

        $message = $isSuccess
            ? 'Payment completed & Order placed successfully!'
            : 'Payment '.$status.' — your order was not placed.';
        toast($message, $isSuccess ? 'success' : 'info');

        // A cancelled payment must not open the (now hidden) order detail page.
        if (! $isSuccess) {
            if ($order->user) {
                return redirect()->route('buying-history');
            }
            return redirect()->route('home');
        }

        if ($order->user) {
            return redirect()->route('buying-history.show', $order->id)->with('success', $message);
        }

        return redirect()->route('home')->with('success', $message);
    }
}
