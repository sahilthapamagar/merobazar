<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $status;
    public ?string $customNote;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, ?string $customNote = null, ?string $explicitStatus = null)
    {
        $this->order = $order->loadMissing(['seller', 'user.deliveryAddresses', 'orderItems.product']);
        $this->status = strtolower($explicitStatus ?? $order->status ?? 'pending');
        $this->customNote = $customNote;
    }

    public function envelope(): Envelope
    {
        $subject = match ($this->status) {
            'cancelled' => "MeroBazar - Order #{$this->order->id} Has Been Cancelled",
            'delivered' => "MeroBazar - Order #{$this->order->id} Has Been Delivered",
            'processing' => "MeroBazar - Order #{$this->order->id} is Now Processing",
            'shipped' => "MeroBazar - Order #{$this->order->id} Has Shipped & Is On The Way",
            default => "MeroBazar - Order #{$this->order->id} Status: Pending (Order Placed)",
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order-status-updated',
            with: [
                'order' => $this->order,
                'status' => $this->status,
                'customNote' => $this->customNote,
                'seller' => $this->order->seller,
                'user' => $this->order->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
