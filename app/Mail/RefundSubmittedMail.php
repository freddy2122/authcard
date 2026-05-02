<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefundSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, string|null>  $payload
     */
    public function __construct(
        public array $payload
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.refund_user.subject', [
                'site' => config('site.name_short', 'Authentify'),
                'ref' => $this->payload['reference'],
            ]),
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.refund-submitted',
            text: 'emails.refund-submitted-text',
        );
    }
}
