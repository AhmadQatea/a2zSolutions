<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config("notifications.receipt_subjects.{$type}") }}</title>
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
                            <h1 style="margin:0 0 16px;font-size:22px;">مرحباً {{ $name }}</h1>

                            @switch($type)
                                @case('quote')
                                    <p style="font-size:16px;line-height:1.8;margin:0 0 16px;">
                                        شكراً لاهتمامك بـ A2Z Solutions. استلمنا طلب عرض السعر وسنراجع تفاصيل مشروعك خلال 24 ساعة عمل.
                                    </p>
                                    @break
                                @case('booking')
                                    <p style="font-size:16px;line-height:1.8;margin:0 0 16px;">
                                        تم تسجيل طلب حجز الاستشارة بنجاح. سنتواصل معك قريباً لتأكيد الموعد عبر البريد أو واتساب.
                                    </p>
                                    @break
                                @default
                                    <p style="font-size:16px;line-height:1.8;margin:0 0 16px;">
                                        شكراً لتواصلك معنا. استلمنا رسالتك وسيرد عليك فريقنا خلال 24 ساعة عمل.
                                    </p>
                            @endswitch

                            <p style="font-size:15px;line-height:1.8;margin:0;color:#5b6475;">
                                للاستفسار العاجل يمكنك التواصل عبر واتساب:
                                <a href="https://wa.me/{{ config('site.contact.whatsapp') }}" style="color:#0b1326;">{{ config('site.contact.phone') }}</a>
                            </p>

                            <p style="margin-top:24px;font-size:14px;color:#5b6475;">
                                مع تحيات فريق A2Z Solutions — حلول تقنية سورية
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
