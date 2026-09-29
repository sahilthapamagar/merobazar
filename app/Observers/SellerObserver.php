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
     * Map of seller ID or object hash to plain password during state transition.
     */
    protected static array $plainPasswords = [];

    /**
     * Handle the Seller "updating" event before saving.
     */
    public function updating(Seller $seller): void
    {
        // Handle renewal: if ONLY expired_date changed to a future date and status was inactive
        if ($seller->isDirty('expired_date') && ! $seller->isDirty('status') && $seller->expired_date >= now()->toDateString() && $seller->getOriginal('status') === 'inactive') {
            $seller->status = 'active';
        }

        // When transitioning to active and no password is set
        if ($seller->isDirty('status') && $seller->status === 'active' && empty($seller->password)) {
            $plainPassword = \Illuminate\Support\Str::random(10);
            $seller->password = Hash::make($plainPassword);
            if (! $seller->expired_date) {
                $seller->expired_date = now()->addYear()->toDateString();
            }
            $seller->_plain_password = $plainPassword;
            $key = $seller->id ?: spl_object_hash($seller);
            static::$plainPasswords[$key] = $plainPassword;
        }

        // Ensure _plain_password is never in Eloquent's database attributes array
        if (array_key_exists('_plain_password', $seller->getAttributes())) {
            $seller->offsetUnset('_plain_password');
        }
    }

    /**
     * Handle the Seller "updated" event after saving.
     */
    public function updated(Seller $seller): void
    {
        $key = $seller->id ?: spl_object_hash($seller);
        $plainPassword = $seller->_plain_password ?? (static::$plainPasswords[$key] ?? null);

        if (! empty($plainPassword)) {
            try {
                Mail::to($seller->email)->send(new SellerApprovalMail($seller, $plainPassword, $seller->khalti_secrect_key));
                \Illuminate\Support\Facades\Log::info("Seller approval mail sent successfully to {$seller->email}");
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error("Failed to send seller approval mail to {$seller->email}: " . $e->getMessage());
            } finally {
                unset(static::$plainPasswords[$key]);
                $seller->_plain_password = null;
            }
        } elseif ($seller->wasChanged('status') && $seller->status === 'rejected') {
            try {
                Mail::to($seller->email)->send(new SellerRejectMail($seller));
                \Illuminate\Support\Facades\Log::info("Seller rejection mail sent successfully to {$seller->email}");
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error("Failed to send seller rejection mail to {$seller->email}: " . $e->getMessage());
            }
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
