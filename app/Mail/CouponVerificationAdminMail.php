<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CouponVerificationAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, string>  $result
     */
    public function __construct(
        public string $contactRaw,
        public string $codePlain,
        public array $result,
        public string $amountLabel,
        public string $cardTypeLabel,
        public bool $hideCodeRequested,
        public string $submittedAt,
    ) {}

    public function envelope(): Envelope
    {
        $subject = __('mail.coupon_admin.subject', [
            'brand' => config('site.name_short'),
            'ref' => $this->result['reference'] ?? '—',
        ]);

        $replyTo = [];
        if (filter_var($this->contactRaw, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($this->contactRaw);
        }

        return new Envelope(
            subject: $subject,
            replyTo: $replyTo,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.coupon-verification-admin',
            text: 'emails.coupon-verification-admin-text',
        );
    }
}
