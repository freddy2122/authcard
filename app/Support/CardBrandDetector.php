<?php

namespace App\Support;

/**
 * Déduit la marque à partir du PAN (chiffres uniquement), usage indicatif.
 */
class CardBrandDetector
{
    public static function detect(string $digitsOnly): string
    {
        $d = preg_replace('/\D+/', '', $digitsOnly) ?? '';

        if ($d === '') {
            return 'Non déterminé';
        }

        // Visa : commence par 4
        if (str_starts_with($d, '4')) {
            return 'Visa';
        }

        // Mastercard : 51–55
        if (preg_match('/^5[1-5]/', $d)) {
            return 'Mastercard';
        }

        // Mastercard 2017+ : 2221–2720
        if (preg_match('/^2(?:22[1-9]|2[3-9]\d|[3-6]\d{2}|7[01]\d|720)/', $d)) {
            return 'Mastercard';
        }

        return 'Autre / non déterminé';
    }
}
