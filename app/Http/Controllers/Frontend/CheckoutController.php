<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function checkout($id)
    {
        $seller = Seller::findOrFail($id);
        $user = Auth::guard('web')->user();
        $carts = Cart::with(['product', 'productVarient'])
            ->where('user_id', $user->id)
            ->where('seller_id', $id)
            ->get();

        return view('frontend.checkout', compact('seller', 'carts'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'address_detail' => 'required|string|max:500',
            'contact' => 'required|string|max:10',
            'payment_method' => 'required|in:cod,khalti',
        ]);

        $seller = Seller::findOrFail($id);
        $user = Auth::guard('web')->user();
        $carts = Cart::with(['product', 'productVarient'])
            ->where('user_id', $user->id)
            ->where('seller_id', $id)
            ->get();

        if (! $user->delivery_address) {
            $delivery_address = new DeliveryAddress;
            $delivery_address->user_id = $user->id;
            $delivery_address->address_detail = $request->address_detail;
            $delivery_address->contact = $request->contact;
            $delivery_address->save();
        } else {
            $delivery_address = $user->delivery_address;
            $delivery_address->address_detail = $request->address_detail;
            $delivery_address->contact = $request->contact;
            $delivery_address->save();
        }

        $order = new Order;
        $order->user_id = $user->id;
        $order->seller_id = $seller->id;
        $order->total_amount = $carts->sum('amount');
        $order->payment_method = $request->payment_method;
        $order->save();

        foreach ($carts as $cart) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;
            $orderItem->product_varient_id = $cart->product_varient_id;
            $orderItem->quantity = $cart->quantity;
            $orderItem->amount = $cart->amount;
            $orderItem->save();
            $cart->delete();
        }

        if ($request->payment_method == 'cod') {
            toast('Order placed sucessfully', 'success');

            return redirect()->route('cart.index');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Key '.$seller->khalti_secrect_key,
        ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('khalti.callback', $id),
            'website_url' => route('home'),
            'amount' => $order->total_amount * 100,
            'purchase_order_id' => $id,
            'purchase_order_name' => $id,
        ]);
        $data = $response->json();

        return redirect($data['payment_url']);
    }

    public function khalti_callback(Request $request, $id)
    {
        $order = Order::findorFail($id);
        $order->payment_status = $request['"status'];
        $order->save();
        $toast_message = 'Order '.$request['status'].'sucessfully';

        toast($toast_message, 'success');

        return redirect()->route('home');

    }
}
