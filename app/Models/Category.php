<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use PhpParser\Node\Expr\Cast;

class ProductVarient extends Model
{
    protected $fillable = [
        'title',
        'price',
        'product_id',
        'images',
        'stock',
        'compare_price',
        'name',
    ];

    protected $casts = [
        'images' => 'array',
        'stock' => 'integer',
        'price' => 'float',
        'compare_price' => 'float',
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
