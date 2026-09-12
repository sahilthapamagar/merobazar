<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $seller_id
 * @property string $status
 * @property string $payment_status
 * @property float $total_amount
 * @property string $payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\Seller $seller
 * @property-read \App\Models\User $user
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
    ];

    protected function casts(): array
    {
        return [
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
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
