<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property float $price
 * @property float|null $discounted_price
 * @property string $main_image
 * @property array<array-key, mixed>|null $images
 * @property int $seller_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read float $effective_price
 * @property-read bool $is_discounted
 * @property-read int $discount_percent
 * @property-read bool $is_new
 * @property-read string|null $main_image_url
 * @property-read array<array-key, string> $image_urls
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\Seller $seller
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDiscountedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'images' => 'array',
            'price' => 'float',
            'discounted_price' => 'float',
        ];
    }

    /**
     * Resolve an image value (full URL or stored path) into a usable URL.
     *
     * Values that are already absolute URLs are returned unchanged. Values
     * stored by the file uploader (e.g. "products/images/abc.jpg") are resolved
     * to their public URL under the storage disk.
     */
    public static function resolveImageUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        // Already a full URL (http/https), protocol-relative (//host), or data URI.
        if (preg_match('#^(?:https?:)?//|^data:|^blob:#i', $path)) {
            return $path;
        }

        // Stored path on the public disk — prefix if not already present.
        $relative = str_starts_with($path, 'storage/') ? $path : 'storage/'.ltrim($path, '/');

        return asset($relative);
    }

    /**
     * Fully-qualified URL for the main product image.
     */
    public function getMainImageUrlAttribute(): ?string
    {
        return static::resolveImageUrl($this->main_image);
    }

    /**
     * Fully-qualified URLs for the additional gallery images.
     */
    public function getImageUrlsAttribute(): array
    {
        return array_values(array_filter(array_map(
            static fn ($image): ?string => static::resolveImageUrl(is_string($image) ? $image : null),
            is_array($this->images) ? $this->images : [],
        )));
    }

    /**
     * The effective price a customer pays (discounted price when available).
     */
    public function getEffectivePriceAttribute(): float
    {
        return $this->is_discounted ? (float) $this->discounted_price : (float) $this->price;
    }

    /**
     * Whether this product currently has an active discount.
     */
    public function getIsDiscountedAttribute(): bool
    {
        return $this->discounted_price !== null
            && (float) $this->discounted_price > 0
            && (float) $this->discounted_price < (float) $this->price;
    }

    /**
     * Discount percentage (rounded), e.g. 10 for 10% off.
     */
    public function getDiscountPercentAttribute(): int
    {
        if (! $this->is_discounted) {
            return 0;
        }

        return (int) round(((float) $this->price - (float) $this->discounted_price) / (float) $this->price * 100);
    }

    /**
     * Whether the product is "new" (created within the last 7 days).
     */
    public function getIsNewAttribute(): bool
    {
        return $this->created_at !== null && $this->created_at->gt(now()->subDays(7));
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
