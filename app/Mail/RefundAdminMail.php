<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefundAdminMail extends Mailable
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
        $subject = __('mail.refund_admin.subject', [
            'brand' => config('site.name_short'),
            'ref' => $this->payload['reference'],
        ]);

        $replyTo = [];
        $email = $this->payload['email'] ?? '';
        if (is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $name = trim(($this->payload['first_name'] ?? '').' '.($this->payload['last_name'] ?? ''));
            $replyTo[] = $name !== ''
                ? new Address($email, $name)
                : new Address($email);
        }

        return new Envelope(
            subject: $subject,
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.refund-admin',
            text: 'emails.refund-admin-text',
        );
    }
}
