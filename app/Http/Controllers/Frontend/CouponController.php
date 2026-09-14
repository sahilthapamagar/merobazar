<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:64'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $coupon = Coupon::whereRaw('UPPER(code) = ?', [strtoupper($validated['code'])])
            ->where('active', true)
            ->first();

        if (! $coupon) {
            toast('That coupon code is not valid.', 'error');

            return back();
        }

        $subtotal = (float) $validated['amount'];
        $discount = $coupon->discountFor($subtotal);

        if ($discount <= 0) {
            toast(
                $subtotal < (float) $coupon->min_spend
                    ? 'This coupon requires a minimum spend of Rs. '.number_format((float) $coupon->min_spend, 2).'.'
                    : 'This coupon is no longer available.',
                'error'
            );

            return back();
        }

        session(['coupon_code' => $coupon->code]);

        toast('Coupon applied. You saved Rs. '.number_format($discount, 2).'.', 'success');

        return back();
    }

    public function clear()
    {
        session()->forget('coupon_code');

        toast('Coupon removed.', 'info');

        return back();
    }
}