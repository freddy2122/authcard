<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('mail.refund_admin.doc_title') }}</title>
</head>
<body style="margin:0;font-family:system-ui,sans-serif;background:#f1f5f9;padding:24px;color:#0f172a;">
    <p style="margin:0 0 16px;font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:0.08em;">{{ __('mail.refund_admin.team_notice', ['name' => config('site.name')]) }}</p>
    <table role="presentation" width="100%" style="max-width:640px;margin:0 auto;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 4px 24px rgba(15,23,42,0.06);">
        <tr>
            <td style="padding:22px 26px;background:linear-gradient(135deg,#0284c7,#38bdf8);color:#fff;">
                <p style="margin:0;font-size:12px;opacity:0.95;">{{ __('mail.refund_admin.heading_new') }}</p>
                <h1 style="margin:10px 0 0;font-size:20px;font-weight:700;">{{ __('mail.refund_admin.ref_line', ['ref' => $payload['reference']]) }}</h1>
                <p style="margin:8px 0 0;font-size:13px;opacity:0.95;">{{ __('mail.refund_admin.received_at', ['date' => $payload['submitted_at']]) }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding:26px;">
                <p style="margin:0 0 18px;font-size:14px;line-height:1.6;color:#475569;">{{ __('mail.refund_admin.intro') }}</p>

                <table role="presentation" width="100%" style="font-size:14px;color:#334155;border-collapse:separate;border-spacing:0;">
                    <tr style="background:#f8fafc;">
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;width:40%;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_email') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;word-break:break-all;"><a href="mailto:{{ $payload['email'] }}" style="color:#0284c7;font-weight:600;">{{ $payload['email'] }}</a></td>
                    </tr>
                    <tr>
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_name') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;">{{ $payload['first_name'] }} {{ $payload['last_name'] }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_network') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;font-weight:600;">{{ $payload['detected_brand'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_pan') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;font-family:ui-monospace,monospace;">{{ $payload['pan_masked'] }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_exp') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;">{{ $payload['exp_month'] }} / {{ $payload['exp_year'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_cvv') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;color:#94a3b8;">{{ $payload['cvv_masked'] }} <span style="font-size:11px;">{{ __('mail.refund_admin.cvv_note') }}</span></td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_type') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;">{{ $payload['card_type_label'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_code') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;font-family:ui-monospace,monospace;">{{ $payload['recharge_code_masked'] }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;border-bottom:1px solid #e2e8f0;">{{ __('mail.refund_admin.lbl_country') }}</td>
                        <td style="padding:12px 14px;border-bottom:1px solid #e2e8f0;">{{ $payload['country_label'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px 14px;font-weight:600;color:#64748b;">{{ __('mail.refund_admin.lbl_city') }}</td>
                        <td style="padding:12px 14px;">{{ $payload['city_postal'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
