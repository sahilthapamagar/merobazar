<?php

namespace App\Listeners;

use App\Support\GuestCartMerger;
use Illuminate\Auth\Events\Login;

class MergeGuestCartOnLogin
{
    public function __construct(private GuestCartMerger $merger) {}

    /**
     * Anything that signs a shopper in - password login, registration or
     * Socialite - lands here, so a cart built before logging in is never lost.
     */
    public function handle(Login $event): void
    {
        $this->merger->handle($event->user);
    }
}
