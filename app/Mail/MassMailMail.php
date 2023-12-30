<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MassMailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;

    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->maildata['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $maildata = $this->maildata;
        return new Content(
            view: 'backend.Mail.AdminMassMail'
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
