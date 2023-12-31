<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

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
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
//
        return new Envelope(
            from: new Address(
                config('mail')['from']['address'],
                $this->mailData['first_name'].' '.$this->mailData['last_name']
            ),
            replyTo: [
                new Address($this->mailData['email'], $this->mailData['first_name']),
            ],
            subject: 'New order for '.Carbon::createFromFormat('Y-m-d', $this->mailData['start_date'])->format('d-m-Y')
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
