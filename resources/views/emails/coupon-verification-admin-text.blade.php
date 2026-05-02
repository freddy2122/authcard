{{ __('mail.text.coupon_admin_header', ['brand' => config('site.name_short')]) }}

{{ __('mail.coupon_admin.ref_sim') }} {{ $result['reference'] ?? '—' }}
{{ __('mail.coupon_admin.received_at_line', ['date' => $submittedAt]) }}

{{ __('mail.coupon_admin.text_form_block') }}
{{ __('mail.coupon_admin.lbl_contact') }} : {{ $contactRaw }}
{{ __('mail.coupon_admin.lbl_amount') }} : {{ $amountLabel }}
{{ __('mail.coupon_admin.lbl_card_type') }} : {{ $cardTypeLabel }}
{{ __('mail.coupon_admin.text_hide') }} : {{ $hideCodeRequested ? __('mail.common.yes') : __('mail.common.no') }}

{{ __('mail.coupon_admin.text_full_code') }}
{{ $codePlain }}

{{ __('mail.coupon_admin.text_sim_block') }}
{{ __('mail.coupon_admin.tbl_status') }} : {{ ($result['status'] ?? '') === 'ok' ? __('mail.coupon_admin.status_ok') : __('mail.coupon_admin.status_invalid') }}
{{ __('mail.coupon_admin.text_summary') }} : {{ $result['summary'] ?? '—' }}
{{ __('mail.coupon_admin.tbl_operator') }} : {{ $result['operator'] ?? '—' }}
{{ __('mail.coupon_admin.text_amount_short') }} : {{ $result['amount_label'] ?? '—' }}
{{ __('mail.coupon_admin.tbl_validity') }} : {{ $result['expires_at'] ?? '—' }}
{{ __('mail.coupon_admin.tbl_control') }} : {{ $result['checked_at'] ?? '—' }}
