<?php

use App\Models\Product;
use Tests\TestCase;

uses(TestCase::class);

it('returns absolute urls unchanged', function () {
    expect(Product::resolveImageUrl('https://images.unsplash.com/photo-1596755094514?w=600&q=80&auto=format'))
        ->toBe('https://images.unsplash.com/photo-1596755094514?w=600&q=80&auto=format');
});

it('resolves stored paths to public storage urls', function () {
    $url = Product::resolveImageUrl('products/images/abc.jpg');

    expect($url)->toBeString()
        ->toStartWith('http')
        ->toEndWith('/storage/products/images/abc.jpg');
});

it('does not double-prefix values that already start with storage', function () {
    $url = Product::resolveImageUrl('storage/products/images/abc.jpg');

    expect($url)->toEndWith('/storage/products/images/abc.jpg')
        ->and(substr_count($url, '/storage/'))->toBe(1);
});

it('returns null for blank values', function () {
    expect(Product::resolveImageUrl(''))->toBeNull();
    expect(Product::resolveImageUrl(null))->toBeNull();
});
