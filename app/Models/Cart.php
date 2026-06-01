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
