<?php

namespace App\Services;

use Illuminate\Support\Carbon;

/**
 * Vérification factice : aucune base de données, logique déterministe pour la démo.
 */
class CouponVerificationService
{
    /**
     * @return array{
     *     status: string,
     *     summary: string,
     *     operator: string,
     *     amount_label: string,
     *     expires_at: string,
     *     reference: string,
     *     checked_at: string
     * }
     */
    public function verify(string $rawCode): array
    {
        $normalized = strtoupper(preg_replace('/\s+/u', '', trim($rawCode)) ?? '');
        $locale = app()->getLocale();

        if ($normalized === '' || strlen($normalized) < 6) {
            return $this->failurePayload($rawCode, __('coupon_verification.failure_short_code'), $locale);
        }

        if (str_contains($normalized, 'INVALID') || str_contains($normalized, 'USED')) {
            return $this->failurePayload($rawCode, __('coupon_verification.failure_invalid'), $locale);
        }

        $operators = ['Orange', 'SFR', 'Free', 'Bouygues'];
        $amounts = $this->translatedAmounts();
        $hash = crc32($normalized);
        $operator = $operators[abs($hash) % count($operators)];
        $amount = $amounts[abs($hash >> 8) % count($amounts)];

        $expiryDays = 30 + (abs($hash >> 16) % 335);
        $expiresAt = Carbon::now()->addDays($expiryDays)->locale($locale)->isoFormat('L');
        $checkedAt = Carbon::now()->locale($locale)->isoFormat('L LTS');

        return [
            'status' => 'ok',
            'summary' => __('coupon_verification.summary_ok'),
            'operator' => $operator,
            'amount_label' => $amount,
            'expires_at' => $expiresAt,
            'reference' => 'AUTH-'.strtoupper(substr(sha1($normalized), 0, 10)),
            'checked_at' => $checkedAt,
        ];
    }

    /**
     * @return array<string>
     */
    private function translatedAmounts(): array
    {
        $amounts = trans('coupon_verification.amounts');

        return is_array($amounts) && $amounts !== [] ? array_values($amounts) : ['5 €', '10 €', '15 €', '20 €', '25 €'];
    }

    /**
     * @return array{
     *     status: string,
     *     summary: string,
     *     operator: string,
     *     amount_label: string,
     *     expires_at: string,
     *     reference: string,
     *     checked_at: string
     * }
     */
    private function failurePayload(string $rawCode, string $reason, string $locale): array
    {
        $normalized = strtoupper(preg_replace('/\s+/u', '', trim($rawCode)) ?? '');
        $dash = __('coupon_verification.dash');
        $checkedAt = Carbon::now()->locale($locale)->isoFormat('L LTS');

        return [
            'status' => 'invalid',
            'summary' => $reason,
            'operator' => $dash,
            'amount_label' => $dash,
            'expires_at' => $dash,
            'reference' => $normalized !== '' ? 'REF-'.strtoupper(substr(sha1($normalized), 0, 8)) : $dash,
            'checked_at' => $checkedAt,
        ];
    }
}
