<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CouponVerificationResultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, string>  $result
     */
    public function __construct(
        public string $codePlain,
        public array $result,
        public string $contactRaw,
        public string $amountLabel,
        public string $cardTypeLabel,
        public bool $sentToContactEmail,
    ) {}

    public function envelope(): Envelope
    {
        $site = config('site.name_short', 'Authentify');
        $subject = $this->result['status'] === 'ok'
            ? __('mail.coupon_user.subject_ok', ['site' => $site])
            : __('mail.coupon_user.subject_issue', ['site' => $site]);

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.coupon-verification-result',
            text: 'emails.coupon-verification-result-text',
        );
    }
}
