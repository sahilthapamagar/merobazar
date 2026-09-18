<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::guard('web')->id())
            ->latest()
            ->get();

        return view('frontend.wishlist', compact('wishlists'));
    }

    public function toggle(Product $product)
    {
        $userId = Auth::guard('web')->id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            toast('Removed from wishlist', 'success');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);
            toast('Added to wishlist', 'success');
        }

        return back();
    }

    public function destroy(Wishlist $wishlist)
    {
        abort_unless($wishlist->user_id === Auth::guard('web')->id(), 403);

        $wishlist->delete();
        toast('Removed from wishlist', 'success');

        return back();
    }
}
