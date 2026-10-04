<?php

namespace App\Filament\Seller\Resources\Orders\Pages;

use App\Filament\Seller\Resources\Orders\OrderResource;
use App\Mail\OrderStatusUpdatedMail;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $order = $this->record;

        // Guest checkouts have no account, so they are emailed the address they
        // gave at checkout instead.
        $recipient = $order->user?->email ?: $order->billing_email;

        // Automatically email the buyer whenever save changes is clicked
        if (! $recipient) {
            return;
        }

        try {
            Mail::to($recipient)->send(new OrderStatusUpdatedMail($order, null, $order->status));

            Notification::make()
                ->title('Order Saved & Customer Notified')
                ->body("Order status set to '{$order->status}'. Status email sent automatically to {$recipient}.")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Log::error('Order status update mail error: '.$e->getMessage());

            Notification::make()
                ->title('Order Saved (Email Failed)')
                ->body('Order saved, but email could not be delivered: '.$e->getMessage())
                ->warning()
                ->send();
        }
    }
}
