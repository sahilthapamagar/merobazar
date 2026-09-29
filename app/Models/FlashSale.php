<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $product_id
 * @property int $seller_id
 * @property float $flash_price
 * @property int $flash_stock
 * @property int $sold_quantity
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @property-read Seller $seller
 * @property-read bool $is_active
 * @property-read bool $is_scheduled
 * @property-read bool $is_expired
 * @property-read bool $is_sold_out
 * @property-read string $current_status_label
 * @property-read int $discount_percent
 * @property-read int $remaining_stock
 */
class FlashSale extends Model
{
    protected $fillable = [
        'product_id',
        'seller_id',
        'flash_price',
        'flash_stock',
        'sold_quantity',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'flash_price' => 'float',
            'flash_stock' => 'integer',
            'sold_quantity' => 'integer',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Active scope: currently within start/end time window and has stock left.
     */
    public function scopeActive(Builder $query): Builder
    {
        $now = now();

        return $query->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->whereColumn('sold_quantity', '<', 'flash_stock');
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('start_time', '>', now());
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('end_time', '<', now());
    }

    public function getIsActiveAttribute(): bool
    {
        $now = now();

        return $this->start_time <= $now
            && $this->end_time >= $now
            && $this->sold_quantity < $this->flash_stock;
    }

    public function getIsScheduledAttribute(): bool
    {
        return $this->start_time > now();
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->end_time < now();
    }

    public function getIsSoldOutAttribute(): bool
    {
        return $this->sold_quantity >= $this->flash_stock;
    }

    public function getRemainingStockAttribute(): int
    {
        return max(0, $this->flash_stock - $this->sold_quantity);
    }

    public function getCurrentStatusLabelAttribute(): string
    {
        if ($this->is_expired) {
            return 'Ended';
        }

        if ($this->is_sold_out) {
            return 'Sold Out';
        }

        if ($this->is_scheduled) {
            return 'Scheduled';
        }

        return 'Active';
    }

    public function getDiscountPercentAttribute(): int
    {
        $original = (float) ($this->product?->price ?? 0);
        if ($original <= 0 || (float) $this->flash_price >= $original) {
            return 0;
        }

        return (int) round(($original - (float) $this->flash_price) / $original * 100);
    }
}
