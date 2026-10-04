<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Order;
use App\Notifications\OrderNotification;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * A buyer has just purchased a product. Notify the seller and every admin.
     * Khalti orders are not real until the payment is confirmed, so they are
     * handled in the "updated" event instead.
     */
    public function created(Order $order): void
    {
        if ($order->payment_method === 'khalti' && ! $this->isPaid($order)) {
            return;
        }

        $this->notifyOrderPlaced($order);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // A Khalti order only becomes a real purchase once the payment completes.
        if ($order->payment_method === 'khalti' && $order->wasChanged('payment_status') && $this->isPaid($order)) {
            $this->notifyOrderPlaced($order);
        }
    }

    protected function isPaid(Order $order): bool
    {
        return strtolower((string) $order->payment_status) === 'completed';
    }

    protected function notifyOrderPlaced(Order $order): void
    {
        $sellerName = $order->seller?->shop_name ?? 'a seller';
        $customerName = $order->user?->name ?? 'a customer';
        $amount = number_format((float) $order->total_amount, 2);

        $this->notifySeller(
            $order,
            "New order #{$order->id}",
            "You received a new order from {$customerName} worth NPR {$amount}.",
            Heroicon::OutlinedShoppingCart,
        );

        $this->notifyAdmins(
            $order,
            "New order #{$order->id}",
            "{$customerName} placed an order with {$sellerName} worth NPR {$amount}.",
            Heroicon::OutlinedShoppingCart,
        );
    }

    protected function notifySeller(Order $order, string $title, string $body, Heroicon $icon): void
    {
        if (! $order->seller) {
            return;
        }

        $this->notify($order, 'seller', [$order->seller], $title, $body, $icon);
    }

    protected function notifyAdmins(Order $order, string $title, string $body, Heroicon $icon): void
    {
        $admins = Admin::query()->get();

        if ($admins->isEmpty()) {
            return;
        }

        $this->notify($order, 'admin', $admins->all(), $title, $body, $icon);
    }

    /**
     * @param  array<int, Model>  $recipients
     */
    protected function notify(Order $order, string $panel, array $recipients, string $title, string $body, Heroicon $icon): void
    {
        if (empty($recipients)) {
            return;
        }

        $notification = Notification::make()
            ->title($title)
            ->body($body)
            ->success()
            ->icon($icon);

        if ($url = $this->orderUrl($order, $panel)) {
            $notification->actions([
                Action::make('view')
                    ->label('View order')
                    ->url($url)
                    ->markAsRead(),
            ]);
        }

        // Store the Filament-formatted payload directly instead of using the
        // queued DatabaseNotification so the bell updates without a queue worker.
        $data = $notification->getDatabaseMessage();

        foreach ($recipients as $recipient) {
            $recipient->notify(new OrderNotification($data));
        }
    }

    protected function orderUrl(Order $order, string $panel): ?string
    {
        $routeName = "filament.{$panel}.resources.orders.edit";

        if (! Route::has($routeName)) {
            return null;
        }

        return route($routeName, ['record' => $order]);
    }
}
