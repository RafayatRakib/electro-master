<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

   public $order;
   public $currency;
    public function __construct($order,$currency)
    {
        $this->order = $order;
        $this->currency = $currency;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmed',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'backend.Mail.AdminOrderConfirmationMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
