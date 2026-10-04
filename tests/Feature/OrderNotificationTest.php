<?php

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;

function makeAdmin(): Admin
{
    return Admin::create([
        'name' => 'Test Admin',
        'email' => 'admin@example.com',
        'password' => 'secret',
    ]);
}

function makeOrder(Seller $seller, string $paymentMethod = 'cod', ?string $paymentStatus = null, string $status = 'pending'): Order
{
    return Order::create([
        'user_id' => User::factory()->create()->id,
        'seller_id' => $seller->id,
        'status' => $status,
        'total_amount' => 1500,
        'payment_method' => $paymentMethod,
        'payment_status' => $paymentStatus ?? 'pending',
    ]);
}

it('notifies the seller and every admin when a buyer places a cash on delivery order', function () {
    $seller = Seller::factory()->create();
    $admin = makeAdmin();

    $order = makeOrder($seller);

    expect($seller->fresh()->notifications()->count())->toBe(1)
        ->and($admin->fresh()->notifications()->count())->toBe(1);

    $notification = $seller->fresh()->notifications()->first();
    expect($notification->data['title'])->toContain("New order #{$order->id}")
        ->and($notification->data['format'])->toBe('filament')
        ->and($notification->data['status'])->toBe('success');
});

it('does not notify for a khalti order that is not paid yet', function () {
    $seller = Seller::factory()->create();
    makeAdmin();

    makeOrder($seller, paymentMethod: 'khalti', paymentStatus: 'pending');

    expect($seller->fresh()->notifications()->count())->toBe(0);
});

it('notifies once the khalti payment completes', function () {
    $seller = Seller::factory()->create();
    $admin = makeAdmin();

    $order = makeOrder($seller, paymentMethod: 'khalti', paymentStatus: 'pending');

    $order->update(['payment_status' => 'Completed']);

    expect($seller->fresh()->notifications()->count())->toBe(1)
        ->and($admin->fresh()->notifications()->count())->toBe(1);
});

it('increases the Orders navigation badge for the seller and admins with each new order', function () {
    $seller = Seller::factory()->create();
    $admin = makeAdmin();

    $this->actingAs($seller, 'vendor');
    expect(App\Filament\Seller\Resources\Orders\OrderResource::getNavigationBadge())->toBeNull();

    makeOrder($seller);
    expect(App\Filament\Seller\Resources\Orders\OrderResource::getNavigationBadge())->toBe('1');

    makeOrder($seller);
    expect(App\Filament\Seller\Resources\Orders\OrderResource::getNavigationBadge())->toBe('2');

    $this->actingAs($admin, 'admin');
    expect(OrderResource::getNavigationBadge())->toBe('2');
});

it('does not notify again when only the order status changes', function () {
    $seller = Seller::factory()->create();
    makeAdmin();
    $order = makeOrder($seller);

    // Ignore the "order placed" notification created on purchase.
    $seller->notifications()->delete();

    $order->update(['status' => 'processing']);
    $order->update(['status' => 'delivered']);

    expect($seller->fresh()->notifications()->count())->toBe(0);
});
