<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SentSellerNewPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $seller,$new_password;
    /**
     * Create a new message instance.
     */
    public function __construct($seller,$new_password)
    {
        $this->seller=$seller;
        $this->new_password=$new_password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sent Seller New Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.sellers.SentSellerNewPassword',
            with:[
                'seller'=>$this->seller,
                'new_password'=>$this->new_password,
            ]
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
