<?php

use App\Models\Order;
use App\Models\Seller;
use App\Models\User;

it('stamps shipped_at the first time an order moves to processing', function () {
    $order = Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => 1000,
        'payment_method' => 'cod',
    ]);

    expect($order->shipped_at)->toBeNull();

    $order->update(['status' => 'processing']);

    expect($order->fresh()->shipped_at)->not->toBeNull();
});

it('stamps delivered_at when an order is marked delivered', function () {
    $order = Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => 1000,
        'payment_method' => 'cod',
    ]);

    $order->update(['status' => 'delivered']);

    $order = $order->fresh();

    expect($order->delivered_at)->not->toBeNull()
        ->and($order->shipped_at)->not->toBeNull();
});

it('keeps the original shipped_at on later status changes', function () {
    $order = Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => 1000,
        'payment_method' => 'cod',
    ]);

    $order->update(['status' => 'processing']);
    $firstShippedAt = $order->fresh()->shipped_at;

    $order->update(['status' => 'delivered']);

    expect($order->fresh()->shipped_at->eq($firstShippedAt))->toBeTrue();
});

it('leaves the timestamps alone for a cancelled order', function () {
    $order = Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => 1000,
        'payment_method' => 'cod',
    ]);

    $order->update(['status' => 'cancelled']);

    expect($order->fresh()->shipped_at)->toBeNull()
        ->and($order->fresh()->delivered_at)->toBeNull();
});

it('exposes the delivery address for a guest order', function () {
    $order = Order::create([
        'user_id' => null,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'total_amount' => 2500,
        'payment_method' => 'cod',
        'billing_name' => 'Guest Shopper',
        'billing_phone' => '9812345678',
        'billing_address' => 'Balkhu, Ward 4',
        'shipping_address' => 'Balkhu, Ward 4',
        'guest_token' => 'token-123',
    ]);

    expect($order->customer_contact)->toBe('9812345678')
        ->and($order->customer_address)->toBe('Balkhu, Ward 4');
});

it('stores the discount breakdown on the order', function () {
    $order = Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => Seller::factory()->create()->id,
        'status' => 'pending',
        'payment_status' => 'pending',
        'subtotal_amount' => 2000,
        'discount_amount' => 250,
        'total_amount' => 1750,
        'payment_method' => 'cod',
    ]);

    expect((float) $order->discount_amount)->toBe(250.0)
        ->and((float) $order->subtotal_amount)->toBe(2000.0)
        ->and((float) $order->total_amount)->toBe(1750.0);
});
