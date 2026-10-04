<?php

namespace App\Support;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Single source of truth for "whose cart is this?".
 *
 * A cart line belongs either to the signed-in customer or to a guest session.
 * The guest session key is created lazily, the first time a guest actually
 * needs one, so that browsing the storefront never writes to the session.
 */
class GuestCartSession
{
    /**
     * The guest cart key for this session, or null when there isn't one yet.
     *
     * @param  bool  $create  Mint a key if the session doesn't have one yet.
     */
    public static function id(bool $create = false): ?string
    {
        $id = session('guest_cart_session_id');

        if ($id === null && $create) {
            $id = Str::uuid()->toString();
            session(['guest_cart_session_id' => $id]);
        }

        return $id;
    }

    /**
     * Drop this session's guest cart key.
     */
    public static function forget(): void
    {
        session()->forget('guest_cart_session_id');
    }

    /**
     * Scope a cart query to whoever is currently shopping.
     */
    public static function scope(Builder $query): Builder
    {
        $user = Auth::guard('web')->user();

        if ($user) {
            return $query->where('user_id', $user->id);
        }

        return $query->whereNull('user_id')
            ->where('guest_session_id', self::id(create: true));
    }

    /**
     * Number of cart lines for the current shopper.
     *
     * Guests without a cart key short-circuit to 0, so a visitor who has never
     * added anything costs no query at all.
     */
    public static function itemCount(): int
    {
        $user = Auth::guard('web')->user();

        if ($user) {
            return $user->carts()->count();
        }

        $guestId = self::id();

        if ($guestId === null) {
            return 0;
        }

        return Cart::whereNull('user_id')
            ->where('guest_session_id', $guestId)
            ->count();
    }
}
