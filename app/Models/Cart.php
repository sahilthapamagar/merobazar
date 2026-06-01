<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'seller_id',
        'product_id',
        'product_varient_id',
        'quantity',
        'amount',
    ];

    public static function lineAmountFor(Product $product, ProductVarient $variant, int $quantity): float
    {
        $unitPrice = (float) $variant->price;

        if ($product->discount > 0) {
            $unitPrice -= $unitPrice * ((float) $product->discount / 100);
        }

        return round($unitPrice * max(1, $quantity), 2);
    }

    public function maxQuantity(): int
    {
        $variant = $this->productVarient;

        if ($variant && isset($variant->stock) && (int) $variant->stock > 0) {
            return (int) $variant->stock;
        }

        return 99;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVarient()
    {
        return $this->belongsTo(ProductVarient::class, 'product_varient_id');
    }
}
