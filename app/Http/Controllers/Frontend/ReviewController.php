<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a review for a single order item.
     */
    public function store(Request $request, Order $order, OrderItem $orderItem)
    {
        // The order must belong to the authenticated user.
        abort_unless((int) $order->user_id === (int) Auth::guard('web')->id(), 403);

        // The item must belong to this order.
        abort_unless((int) $orderItem->order_id === (int) $order->id, 404);

        // Reviews are only allowed once the order has been delivered.
        if ($order->status !== 'delivered') {
            toast('Reviews can only be submitted for delivered orders.', 'error');

            return back();
        }

        // Only one review per order item.
        if ($orderItem->review()->exists()) {
            toast('You have already reviewed this product.', 'error');

            return back();
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        Review::create([
            'user_id' => $order->user_id,
            'product_id' => $orderItem->product_id,
            'order_item_id' => $orderItem->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        toast('Thank you for your review!', 'success');

        return back();
    }
}
