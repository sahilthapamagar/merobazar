<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use PhpParser\Node\Expr\Cast;

class ProductVarient extends Model
{
    protected $casts = [
        'images' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
