<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Curated high-resolution luxury fallback image mapping for categories.
     */
    public static function getDefaultImageUrl(?string $slug = null): string
    {
        $slug = strtolower(trim((string) $slug));

        $map = [
            'mens-wear' => 'https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?w=900&q=80&auto=format',
            'womens-wear' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=900&q=80&auto=format',
            'shoes' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=900&q=80&auto=format',
            'accessories' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=900&q=80&auto=format',
            'health-beauty' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=900&q=80&auto=format',
        ];

        foreach ($map as $key => $url) {
            if ($slug === $key || str_contains($slug, $key)) {
                return $url;
            }
        }

        if (str_contains($slug, 'men')) {
            return $map['mens-wear'];
        }
        if (str_contains($slug, 'women') || str_contains($slug, 'dress') || str_contains($slug, 'wear')) {
            return $map['womens-wear'];
        }
        if (str_contains($slug, 'shoe') || str_contains($slug, 'sneaker') || str_contains($slug, 'footwear')) {
            return $map['shoes'];
        }
        if (str_contains($slug, 'acc') || str_contains($slug, 'bag') || str_contains($slug, 'watch') || str_contains($slug, 'jewelry')) {
            return $map['accessories'];
        }
        if (str_contains($slug, 'beauty') || str_contains($slug, 'health') || str_contains($slug, 'cosmetic') || str_contains($slug, 'skin')) {
            return $map['health-beauty'];
        }

        return 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&q=80&auto=format';
    }

    /**
     * Resolved usable URL for the category banner/thumbnail.
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image;

        if (blank($path)) {
            return static::getDefaultImageUrl($this->slug ?? $this->name);
        }

        // Absolute URL
        if (preg_match('#^(?:https?:)?//|^data:|^blob:#i', $path)) {
            return $path;
        }

        // Check if file actually exists on public disk
        $cleanPath = ltrim(str_replace('storage/', '', $path), '/');
        if (Storage::disk('public')->exists($cleanPath) || file_exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        return static::getDefaultImageUrl($this->slug ?? $this->name);
    }

    /**
     * Fallback URL for onerror handlers.
     */
    public function getFallbackImageUrlAttribute(): string
    {
        return static::getDefaultImageUrl($this->slug ?? $this->name);
    }
}
