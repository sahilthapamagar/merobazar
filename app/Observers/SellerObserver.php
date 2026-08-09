<?php

namespace App\Observers;

use App\Mail\SellerApprovalMail;
use App\Mail\SellerRejectMail;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SellerObserver
{
    /**
     * Handle the Seller "created" event.
     */
    public function created(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "updated" event.
     */
    public function updated(Seller $seller): void
    {
        // Handle renewal: if ONLY expired_date changed to a future date and status was inactive
        if ($seller->isDirty('expired_date') && ! $seller->isDirty('status') && $seller->expired_date >= now()->toDateString() && $seller->getOriginal('status') === 'inactive') {
            $seller->status = 'active';
            $seller->saveQuietly();
            return;
        }

        if ($seller->isDirty('status') && $seller->status === 'active' && ! $seller->password) {
            // Generate a strong random password
            $password = random_bytes(6);
            $seller->password = Hash::make($password);
            $seller->saveQuietly();
            Mail::to($seller->email)->send(new SellerApprovalMail($seller, $password));
        } elseif ($seller->isDirty('status') && $seller->status === 'rejected') {
            Mail::to($seller->email)->send(new SellerRejectMail($seller));
        }
        

    }
    /**
     * Handle the Seller "deleted" event.
     */
    public function deleted(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "restored" event.
     */
    public function restored(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "force deleted" event.
     */
    public function forceDeleted(Seller $seller): void
    {
        //
    }
}
