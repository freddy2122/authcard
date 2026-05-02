<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.coupon_admin.doc_title') }}</title>
</head>
<body style="margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#334155;padding:24px;">
    <p style="margin:0 0 16px;font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:0.08em;">{{ __('mail.coupon_admin.team_notice', ['name' => config('site.name')]) }}</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;border:1px solid #e2e8f0;box-shadow:0 4px 24px rgba(15,23,42,0.06);overflow:hidden;">
        <tr>
            <td style="padding:20px 24px;background:linear-gradient(135deg,#e0f2fe 0%,#f0f9ff 50%,#e0f7fa 100%);border-bottom:1px solid #bae6fd;">
                <h1 style="margin:0;font-size:18px;color:#0c4a6e;">{{ __('mail.coupon_admin.heading') }}</h1>
                <p style="margin:8px 0 0;font-size:13px;color:#0369a1;">{{ __('mail.coupon_admin.ref_sim') }} <strong style="color:#0f172a;font-family:ui-monospace,monospace;">{{ $result['reference'] ?? '—' }}</strong></p>
                <p style="margin:6px 0 0;font-size:12px;color:#64748b;">{{ __('mail.coupon_admin.received_at_line', ['date' => $submittedAt]) }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding:24px;">
                <p style="margin:0 0 16px;font-size:13px;color:#475569;line-height:1.5;">
                    {{ __('mail.coupon_admin.intro_before') }} <strong style="color:#b45309;">{{ __('mail.coupon_admin.code_phrase') }}</strong> {{ __('mail.coupon_admin.intro_after') }}
                </p>

                <table role="presentation" width="100%" style="font-size:14px;border-collapse:collapse;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;">
                    <tr>
                        <td style="padding:10px 12px;background:#f8fafc;color:#475569;width:38%;border-bottom:1px solid #e2e8f0;font-weight:600;">{{ __('mail.coupon_admin.lbl_contact') }}</td>
                        <td style="padding:10px 12px;background:#ffffff;color:#0f172a;font-weight:600;border-bottom:1px solid #e2e8f0;word-break:break-all;">{{ $contactRaw }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 12px;background:#f8fafc;color:#475569;border-bottom:1px solid #e2e8f0;font-weight:600;">{{ __('mail.coupon_admin.lbl_amount') }}</td>
                        <td style="padding:10px 12px;background:#ffffff;color:#0f172a;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $amountLabel }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 12px;background:#f8fafc;color:#475569;border-bottom:1px solid #e2e8f0;font-weight:600;">{{ __('mail.coupon_admin.lbl_card_type') }}</td>
                        <td style="padding:10px 12px;background:#ffffff;color:#0f172a;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $cardTypeLabel }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 12px;background:#f8fafc;color:#475569;border-bottom:1px solid #e2e8f0;font-weight:600;">{{ __('mail.coupon_admin.lbl_hide') }}</td>
                        <td style="padding:10px 12px;background:#ffffff;color:#0f172a;border-bottom:1px solid #e2e8f0;">{{ $hideCodeRequested ? __('mail.common.yes') : __('mail.common.no') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 12px;background:#f8fafc;color:#475569;vertical-align:top;font-weight:600;">{{ __('mail.coupon_admin.lbl_full_code') }}</td>
                        <td style="padding:10px 12px;background:#fffbeb;color:#854d0e;font-family:ui-monospace,monospace;font-size:13px;word-break:break-all;border-left:3px solid #fbbf24;">{{ $codePlain }}</td>
                    </tr>
                </table>

                <p style="margin:20px 0 8px;font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;">{{ __('mail.coupon_admin.sim_title') }}</p>
                <table role="presentation" width="100%" style="font-size:13px;color:#334155;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;background:#ffffff;">
                    <tr style="background:#f8fafc;">
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_admin.tbl_status') }}</td>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;font-weight:600;">
                            {{ ($result['status'] ?? '') === 'ok' ? __('mail.coupon_admin.status_ok') : __('mail.coupon_admin.status_invalid') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_admin.tbl_summary') }}</td>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['summary'] ?? '—' }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_admin.tbl_operator') }}</td>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['operator'] ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_admin.tbl_amount') }}</td>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['amount_label'] ?? '—' }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_admin.tbl_validity') }}</td>
                        <td style="padding:8px 12px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['expires_at'] ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 12px;color:#475569;">{{ __('mail.coupon_admin.tbl_control') }}</td>
                        <td style="padding:8px 12px;text-align:right;color:#0f172a;">{{ $result['checked_at'] ?? '—' }}</td>
                    </tr>
                </table>

                <p style="margin:20px 0 0;font-size:11px;line-height:1.5;color:#64748b;">
                    {{ __('mail.coupon_admin.footer') }}
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
