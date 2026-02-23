<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequest $contactRequest
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New contact request: ' . $this->contactRequest->subject_label,
            replyTo: [$this->contactRequest->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-request-notification',
        );
    }
}
