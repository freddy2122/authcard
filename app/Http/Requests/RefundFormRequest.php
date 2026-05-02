<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RefundFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $countryKeys = array_keys(config('authentify.countries', []));
        $typeKeys = array_keys(config('authentify.card_types', []));

        return [
            'card_number' => ['required', 'string', function (string $attribute, mixed $value, \Closure $fail): void {
                $digits = preg_replace('/\D+/', '', (string) $value) ?? '';
                $len = strlen($digits);
                if ($len < 13 || $len > 19) {
                    $fail('Le numéro de carte doit contenir entre 13 et 19 chiffres.');
                }
            }],
            'exp_month' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])$/'],
            'exp_year' => ['required', 'string', 'regex:/^\d{2}$/', function (string $attribute, mixed $value, \Closure $fail): void {
                $y = (string) $value;
                $year = (int) ('20'.$y);
                $current = (int) date('Y');
                if ($year < $current || $year > $current + 15) {
                    $fail('Année d’expiration invalide.');
                }
            }],
            'cvv' => ['required', 'string', 'regex:/^\d{3,4}$/'],
            'card_type' => ['required', 'string', Rule::in($typeKeys)],
            'recharge_code' => ['required', 'string', 'max:128'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string', Rule::in($countryKeys)],
            'city_postal' => ['required', 'string', 'max:255'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }
            $m = (int) $this->exp_month;
            $yFull = (int) ('20'.(string) $this->exp_year);
            $last = Carbon::createFromDate($yFull, $m, 1)->endOfMonth();
            if ($last->lt(now()->startOfDay())) {
                $validator->errors()->add('exp_month', 'La carte semble expirée.');
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'card_number.required' => 'Le numéro de carte est obligatoire.',
            'exp_month.required' => 'Le mois d’expiration est obligatoire.',
            'exp_month.regex' => 'Indiquez un mois valide (01 à 12).',
            'exp_year.required' => 'L’année d’expiration est obligatoire.',
            'cvv.required' => 'Le CVV est obligatoire.',
            'cvv.regex' => 'Le CVV comporte 3 ou 4 chiffres.',
            'card_type.required' => 'Sélectionnez un type de carte.',
            'recharge_code.required' => 'Le code de recharge est obligatoire.',
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L’e-mail est obligatoire.',
            'country.required' => 'Le pays est obligatoire.',
            'city_postal.required' => 'La ville et le code postal sont obligatoires.',
        ];
    }
}
