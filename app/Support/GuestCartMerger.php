<?php

namespace App\Support;

use App\Models\Cart;
use App\Models\User;

class GuestCartMerger
{
    /**
     * Move the guest's cart onto the account that just signed in.
     *
     * Lines for a product the account already holds have their quantities
     * combined and the guest row removed; everything else is simply
     * reassigned. Returns the number of guest lines that were folded in.
     */
    public function handle(User $user): int
    {
        $guestId = GuestCartSession::id();

        if ($guestId === null) {
            return 0;
        }

        $guestLines = Cart::whereNull('user_id')
            ->where('guest_session_id', $guestId)
            ->with('product')
            ->get();

        if ($guestLines->isEmpty()) {
            GuestCartSession::forget();

            return 0;
        }

        // One query for every line the account already has, instead of a
        // lazy-loaded relation per guest line.
        $existingLines = Cart::where('user_id', $user->id)
            ->whereIn('product_id', $guestLines->pluck('product_id'))
            ->with('product')
            ->get()
            ->keyBy('product_id');

        foreach ($guestLines as $guestLine) {
            $existing = $existingLines->get($guestLine->product_id);

            if ($existing) {
                $existing->quantity += $guestLine->quantity;
                $existing->amount = ($existing->product?->effective_price ?? 0) * $existing->quantity;
                $existing->save();

                $guestLine->delete();

                continue;
            }

            $guestLine->user_id = $user->id;
            $guestLine->guest_session_id = null;
            $guestLine->save();
        }

        GuestCartSession::forget();

        return $guestLines->count();
    }
}
