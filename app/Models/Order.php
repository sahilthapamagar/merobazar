<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $seller_id
 * @property string $status
 * @property string $payment_status
 * @property float $total_amount
 * @property string $payment_method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read Seller $seller
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'seller_id',
        'status',
        'total_amount',
        'payment_method',
        'payment_status',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'shipping_address',
        'guest_token',
        'tracking_number',
        'shipped_at',
        'delivered_at',
        'notes',
        'coupon_id',
        'discount_amount',
        'subtotal_amount',
    ];

    protected function casts(): array
    {
        return [
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
            'discount_amount' => 'float',
            'subtotal_amount' => 'float',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    protected static function booted(): void
    {
        // Keep the delivery timestamps in step with the status so the customer
        // tracking timeline never has to be filled in by hand.
        static::saved(function (Order $order) {
            if (in_array($order->status, ['shipped', 'delivered'], true) && $order->shipped_at === null) {
                $order->forceFill(['shipped_at' => now()])->saveQuietly();
            }

            if ($order->status === 'delivered' && $order->delivered_at === null) {
                $order->forceFill(['delivered_at' => now()])->saveQuietly();
            }
        });
    }

    /**
     * Phone number to reach the customer about this order: the saved delivery
     * address for accounts, the guest-provided number for guest checkouts.
     */
    public function getCustomerContactAttribute(): ?string
    {
        return $this->user?->deliveryAddresses?->contact ?? $this->billing_phone;
    }

    /**
     * Delivery address for the order, falling back to what the guest entered.
     */
    public function getCustomerAddressAttribute(): ?string
    {
        return $this->user?->deliveryAddresses?->address_detail
            ?? $this->shipping_address
            ?? $this->billing_address;
    }

    /**
     * Orders whose Khalti payment was cancelled / expired / failed before completion.
     * These are never real orders, so they are hidden from customers and sellers
     * (the admin panel still sees them).
     */
    public function scopeAbandonedPayment($query)
    {
        $query->where('payment_method', 'khalti')
            ->where('status', 'cancelled')
            ->where('payment_status', '!=', 'Completed');
    }

    /**
     * The inverse of scopeAbandonedPayment(): every legitimate order.
     */
    public function scopeNotAbandonedPayment($query)
    {
        $query->where(function ($q) {
            $q->where('payment_method', '!=', 'khalti')
                ->orWhere('status', '!=', 'cancelled')
                ->orWhere('payment_status', 'Completed');
        });
    }
}
