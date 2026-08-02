<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyingHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with(['seller', 'orderItems.product'])
            ->where('user_id', Auth::guard('web')->id())
            ->latest()
            ->get();

        $stats = [
            'total_orders' => $orders->count(),
            'total_items' => $orders->sum(fn ($order) => (int) $order->orderItems->sum('quantity')),
            'total_spent' => $orders->sum(fn ($order) => (float) $order->total_amount),
        ];

        return view('frontend.buying-history', compact('orders', 'stats'));
    }

    public function show($id)
    {
        $order = Order::with(['seller', 'orderItems.product', 'user.deliveryAddresses'])
            ->where('user_id', Auth::guard('web')->id())
            ->findOrFail($id);

        return view('frontend.order-detail', compact('order'));
    }
}
