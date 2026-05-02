{{ __('mail.text.coupon_user_header', ['name' => config('site.name')]) }}

@if(($result['status'] ?? '') === 'ok')
{{ __('mail.text.coupon_user_ok') }}
@else
{{ __('mail.text.coupon_user_issue') }}
@endif

{{ __('mail.text.coupon_user_intro') }}

@if (! $sentToContactEmail)
{{ __('mail.text.coupon_user_phone') }}
@endif

{{ __('mail.coupon_user.lbl_card_type') }} : {{ $cardTypeLabel }}
{{ __('mail.coupon_user.lbl_amount') }} : {{ $amountLabel }}
{{ __('mail.coupon_user.lbl_contact') }} : {{ $contactMasked }}
@if ($hideCodeRequested)
{{ __('mail.coupon_user.hide_option_full', ['value' => __('mail.common.yes')]) }}
@endif

{{ __('mail.coupon_user.code_prefix') }} {{ $codeMasked }}

{{ $result['summary'] ?? '' }}

{{ __('mail.coupon_user.text_statut') }} : {{ ($result['status'] ?? '') === 'ok' ? __('mail.coupon_user.status_ok') : __('mail.coupon_user.status_invalid') }}
{{ __('mail.coupon_user.text_operator') }} : {{ $result['operator'] ?? '—' }}
{{ __('mail.coupon_user.text_amount') }} : {{ $result['amount_label'] ?? '—' }}
{{ __('mail.coupon_user.text_validity') }} : {{ $result['expires_at'] ?? '—' }}
{{ __('mail.coupon_user.text_reference') }} : {{ $result['reference'] ?? '—' }}
{{ __('mail.coupon_user.text_control') }} : {{ $result['checked_at'] ?? '—' }}

{{ __('mail.coupon_user.text_footer') }}
