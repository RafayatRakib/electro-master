<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Order Return Status Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'backend.Mail.AdminOrderReturnMail'
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
