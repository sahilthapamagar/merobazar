<?php

use App\Models\Admin;
use App\Models\Seller;

beforeEach(function () {
    config(['app.env' => 'local']);
});

it('shows the notifications bell in the admin topbar', function () {
    $admin = Admin::create([
        'name' => 'Probe Admin',
        'email' => 'probe-admin@example.com',
        'password' => 'secret',
    ]);

    $this->actingAs($admin, 'admin')
        ->get('/admin')
        ->assertSuccessful()
        ->assertSee('fi-topbar-database-notifications-btn', false)
        ->assertDontSee('fi-sidebar-database-notifications-btn', false);
});

it('shows the notifications bell in the seller topbar', function () {
    $seller = Seller::factory()->create();

    $this->actingAs($seller, 'vendor')
        ->get('/seller')
        ->assertSuccessful()
        ->assertSee('fi-topbar-database-notifications-btn', false)
        ->assertDontSee('fi-sidebar-database-notifications-btn', false);
});
