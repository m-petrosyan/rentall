<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public object $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct(object $mailData)
    {
        $this->mailData = $mailData;
//        dd($this->mailData);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
//
        return new Envelope(
            from: new Address(config('mail')['from']['address'], $this->mailData['full_name']),
            replyTo: [
                new Address($this->mailData['email'], $this->mailData['full_name']),
            ],
            subject: 'Message rent '.config('app.url'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.rent',
            with: [
                'data' => $this->mailData,
            ],
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
