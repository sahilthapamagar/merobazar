<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $seller;
    public $password;
    public $khaltiKey;

    /**
     * Create a new message instance.
     */
    public function __construct($seller, $password, $khaltiKey = null)
    {
        $this->seller = $seller;
        $this->password = $password;
        $this->khaltiKey = $khaltiKey ?? ($seller->khalti_secrect_key ?? null);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MeroBazar - Seller Account Details & Login Credentials',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.seller-approval',
            with: [
                'seller' => $this->seller,
                'password' => $this->password,
                'khaltiKey' => $this->khaltiKey,
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
