<?php

return [

    'admin_recipients' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('MAIL_ADMIN_ADDRESS', ''))
    ))),

    'fallback_admin_email' => env('MAIL_USERNAME', config('site.contact.email')),

    'subjects' => [
        'contact' => 'رسالة تواصل جديدة — A2Z Solutions',
        'quote' => 'طلب عرض سعر جديد — A2Z Solutions',
        'booking' => 'حجز استشارة جديد — A2Z Solutions',
    ],

    'receipt_subjects' => [
        'contact' => 'تم استلام رسالتك — A2Z Solutions',
        'quote' => 'تم استلام طلب عرض السعر — A2Z Solutions',
        'booking' => 'تم استلام طلب الحجز — A2Z Solutions',
    ],

];
