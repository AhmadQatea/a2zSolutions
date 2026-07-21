<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config("notifications.subjects.{$type}") }}</title>
</head>
<body style="margin:0;padding:24px;background:#f4f6fb;font-family:Tahoma,Arial,sans-serif;color:#0b1326;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="background:#0b1326;color:#ecc246;padding:20px 24px;font-size:20px;font-weight:bold;">
                            A2Z Solutions
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <h1 style="margin:0 0 16px;font-size:22px;">
                                @switch($type)
                                    @case('quote')
                                        طلب عرض سعر جديد
                                        @break
                                    @case('booking')
                                        حجز استشارة جديد
                                        @break
                                    @default
                                        رسالة تواصل جديدة
                                @endswitch
                            </h1>

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-size:15px;line-height:1.7;">
                                <tr>
                                    <td style="padding:8px 0;color:#5b6475;width:140px;">الاسم</td>
                                    <td style="padding:8px 0;"><strong>{{ $payload['name'] ?? '—' }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#5b6475;">البريد</td>
                                    <td style="padding:8px 0;"><a href="mailto:{{ $payload['email'] ?? '' }}">{{ $payload['email'] ?? '—' }}</a></td>
                                </tr>
                                @if (! empty($payload['phone']))
                                    <tr>
                                        <td style="padding:8px 0;color:#5b6475;">الهاتف</td>
                                        <td style="padding:8px 0;" dir="ltr">{{ $payload['phone'] }}</td>
                                    </tr>
                                @endif
                                @if (! empty($payload['project_type']))
                                    <tr>
                                        <td style="padding:8px 0;color:#5b6475;">الموضوع</td>
                                        <td style="padding:8px 0;">{{ $payload['project_type'] }}</td>
                                    </tr>
                                @endif
                                @if (! empty($payload['booking_date']))
                                    <tr>
                                        <td style="padding:8px 0;color:#5b6475;">التاريخ</td>
                                        <td style="padding:8px 0;">{{ $payload['booking_date'] }}</td>
                                    </tr>
                                @endif
                                @if (! empty($payload['time_label']))
                                    <tr>
                                        <td style="padding:8px 0;color:#5b6475;">الوقت</td>
                                        <td style="padding:8px 0;">{{ $payload['time_label'] }}</td>
                                    </tr>
                                @endif
                                @if (! empty($payload['submitted_at']))
                                    <tr>
                                        <td style="padding:8px 0;color:#5b6475;">وقت الإرسال</td>
                                        <td style="padding:8px 0;">{{ $payload['submitted_at'] }}</td>
                                    </tr>
                                @endif
                            </table>

                            @if (! empty($payload['message']))
                                <div style="margin-top:20px;padding:16px;background:#f8fafc;border-radius:8px;">
                                    <strong style="display:block;margin-bottom:8px;">التفاصيل</strong>
                                    <p style="margin:0;white-space:pre-wrap;">{{ $payload['message'] }}</p>
                                </div>
                            @endif

                            @if (! empty($payload['note']))
                                <div style="margin-top:16px;padding:16px;background:#f8fafc;border-radius:8px;">
                                    <strong style="display:block;margin-bottom:8px;">ملاحظة</strong>
                                    <p style="margin:0;white-space:pre-wrap;">{{ $payload['note'] }}</p>
                                </div>
                            @endif

                            <p style="margin-top:24px;font-size:14px;color:#5b6475;">
                                يمكنك الرد مباشرة على بريد العميل أو مراجعة الطلب من لوحة التحكم.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
