<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_spend',
        'max_discount',
        'max_uses',
        'uses_count',
        'per_user_limit',
        'starts_at',
        'ends_at',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'float',
            'min_spend' => 'float',
            'max_discount' => 'float',
            'max_uses' => 'integer',
            'uses_count' => 'integer',
            'per_user_limit' => 'integer',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'active' => 'boolean',
        ];
    }

    public function isValidFor(float $amount): bool
    {
        if (! $this->active) {
            return false;
        }

        if ($this->starts_at !== null && $this->starts_at->isFuture()) {
            return false;
        }

        if ($this->ends_at !== null && $this->ends_at->isPast()) {
            return false;
        }

        if ($this->max_uses !== null && $this->uses_count >= $this->max_uses) {
            return false;
        }

        if ($this->per_user_limit !== null && $this->userHasReachedLimit()) {
            return false;
        }

        return $amount >= (float) $this->min_spend;
    }

    /**
     * Has this shopper already spent the per-customer allowance?
     */
    public function userHasReachedLimit(?User $user = null): bool
    {
        if ($this->per_user_limit === null) {
            return false;
        }

        $user ??= Auth::user();

        if (! $user) {
            return false;
        }

        return $user->orders()
            ->where('coupon_id', $this->id)
            ->where('status', '!=', 'cancelled')
            ->count() >= $this->per_user_limit;
    }

    public function discountFor(float $amount): float
    {
        if (! $this->isValidFor($amount)) {
            return 0.0;
        }

        $discount = $this->type === 'percent'
            ? $amount * ((float) $this->value / 100)
            : (float) $this->value;

        if ($this->max_discount !== null) {
            $discount = min($discount, (float) $this->max_discount);
        }

        return round(min($discount, $amount), 2);
    }
}
