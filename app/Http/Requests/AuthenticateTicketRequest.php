<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthenticateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'hide_code' => $this->boolean('hide_code'),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $amountKeys = array_keys(config('authentify.ticket_amounts', []));
        $typeKeys = array_keys(config('authentify.card_types', []));

        return [
            'contact' => ['required', 'string', 'max:255', $this->emailOrPhoneRule()],
            'amount' => ['required', 'string', Rule::in($amountKeys)],
            'card_type' => ['required', 'string', Rule::in($typeKeys)],
            'code' => ['required', 'string', 'min:4', 'max:128'],
            'hide_code' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return \Closure(string, mixed, \Closure(string): void): void
     */
    private function emailOrPhoneRule(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail): void {
            $v = trim((string) $value);
            if ($v === '') {
                $fail('Le champ contact est obligatoire.');

                return;
            }
            if (filter_var($v, FILTER_VALIDATE_EMAIL)) {
                return;
            }
            $digits = preg_replace('/\D+/', '', $v) ?? '';
            $len = strlen($digits);
            if ($len >= 10 && $len <= 15) {
                return;
            }
            $fail('Indiquez une adresse e-mail valide ou un numéro (10 à 15 chiffres, avec indicatif si besoin).');
        };
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Veuillez sélectionner un montant.',
            'amount.in' => 'Le montant sélectionné n’est pas valide.',
            'card_type.required' => 'Veuillez sélectionner un type de carte.',
            'card_type.in' => 'Le type de carte n’est pas valide.',
            'code.required' => 'Le code de recharge est obligatoire.',
            'code.min' => 'Le code doit contenir au moins :min caractères.',
        ];
    }
}
