<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;

    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation Mail',
        );
    }

    // public function build()
    // {
    //     return $this->view('frontend.Mail.OrderConfirmationMail')
    //                 ->with(['maildata' => $this->maildata]);
    // }

    public function content(): Content
    {
        return new Content(
            view: 'frontend.Mail.OrderConfirmationMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
