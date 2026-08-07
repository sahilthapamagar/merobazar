<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $paymentMethodLabel;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $paymentMethodLabel)
    {
        $this->order = $order;
        $this->paymentMethodLabel = $paymentMethodLabel;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Has Been Placed - MeroBazar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order-placed',
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
