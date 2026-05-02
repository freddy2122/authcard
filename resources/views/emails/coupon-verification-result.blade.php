<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.coupon_user.doc_title') }}</title>
</head>
<body style="margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#334155;padding:24px;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;border:1px solid #e2e8f0;box-shadow:0 4px 24px rgba(15,23,42,0.06);overflow:hidden;">
        <tr>
            <td style="padding:24px 28px;background:linear-gradient(135deg,#e0f2fe 0%,#f0f9ff 100%);border-bottom:1px solid #bae6fd;">
                <p style="margin:0;font-size:14px;color:#0369a1;font-weight:600;">{{ config('site.name') }} — {{ __('mail.coupon_user.confirmation') }}</p>
                <h1 style="margin:12px 0 0;font-size:20px;color:#0c4a6e;">
                    @if(($result['status'] ?? '') === 'ok')
                        {{ __('mail.coupon_user.heading_ok') }}
                    @else
                        {{ __('mail.coupon_user.heading_issue') }}
                    @endif
                </h1>
            </td>
        </tr>
        <tr>
            <td style="padding:24px 28px;">
                <p style="margin:0 0 18px;padding:14px 16px;border-radius:10px;background:#ecfdf5;font-size:14px;line-height:1.55;color:#166534;border:1px solid #bbf7d0;">
                    {{ __('mail.coupon_user.intro_1') }} <strong style="color:#14532d;">{{ __('mail.coupon_user.intro_strong') }}</strong> {{ __('mail.coupon_user.intro_2') }}
                </p>
                @if (! $sentToContactEmail)
                    <p style="margin:0 0 16px;padding:12px;border-radius:8px;background:#fffbeb;font-size:13px;color:#92400e;border:1px solid #fde68a;">
                        {{ __('mail.coupon_user.phone_notice') }}
                    </p>
                @endif
                <p style="margin:0 0 8px;font-size:14px;color:#64748b;">{{ __('mail.coupon_user.lbl_card_type') }}</p>
                <p style="margin:0 0 16px;font-size:14px;color:#0f172a;font-weight:600;">{{ $cardTypeLabel }}</p>
                <p style="margin:0 0 8px;font-size:14px;color:#64748b;">{{ __('mail.coupon_user.lbl_amount') }}</p>
                <p style="margin:0 0 16px;font-size:14px;color:#0f172a;font-weight:600;">{{ $amountLabel }}</p>
                <p style="margin:0 0 8px;font-size:14px;color:#64748b;">{{ __('mail.coupon_user.lbl_contact') }}</p>
                <p style="margin:0 0 16px;font-size:14px;color:#334155;">{{ $contactRaw }}</p>
                <p style="margin:0 0 16px;font-size:14px;line-height:1.6;color:#334155;">
                    {{ __('mail.coupon_user.code_prefix') }} <strong style="color:#0f172a;font-family:ui-monospace,monospace;">{{ $codePlain }}</strong>
                </p>
                <p style="margin:0 0 16px;font-size:14px;line-height:1.6;color:#334155;">
                    {{ $result['summary'] ?? '' }}
                </p>
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;color:#334155;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;">
                    <tr style="background:#f8fafc;">
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_user.tbl_status') }}</td>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;font-weight:600;">
                            {{ ($result['status'] ?? '') === 'ok' ? __('mail.coupon_user.status_ok') : __('mail.coupon_user.status_invalid') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_user.tbl_operator') }}</td>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['operator'] ?? '—' }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_user.tbl_amount_sim') }}</td>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['amount_label'] ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_user.tbl_validity') }}</td>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;text-align:right;color:#0f172a;">{{ $result['expires_at'] ?? '—' }}</td>
                    </tr>
                    <tr style="background:#f8fafc;">
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;color:#475569;">{{ __('mail.coupon_user.tbl_reference') }}</td>
                        <td style="padding:10px 14px;border-bottom:1px solid #e2e8f0;text-align:right;font-family:ui-monospace,monospace;color:#0f172a;">{{ $result['reference'] ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 14px;color:#475569;">{{ __('mail.coupon_user.tbl_control') }}</td>
                        <td style="padding:10px 14px;text-align:right;color:#0f172a;">{{ $result['checked_at'] ?? '—' }}</td>
                    </tr>
                </table>
                <p style="margin:24px 0 0;font-size:12px;line-height:1.5;color:#64748b;">
                    {{ __('mail.coupon_user.footer') }}
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
