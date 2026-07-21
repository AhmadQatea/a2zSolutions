<?php

return [

    'credentials' => [
        'email' => 'a2zsolutions@admin.com',
        'password' => 'ahmad123',
    ],

    'user' => [
        'name' => 'Ahmad Qatea',
        'role' => 'مدير النظام',
        'avatar_initials' => 'AQ',
    ],

    'brand' => [
        'cms_name' => 'A2Z CMS',
        'company' => 'A2Z Solutions',
        'tagline' => 'حلول تقنية متكاملة',
        'logo' => 'assets/images/logo.png',
        'logo_alt' => 'assets/images/logo2.png',
        'pattern' => 'assets/images/mvpd.png',
    ],

    'navigation' => [
        ['route' => 'admin.dashboard', 'label' => 'لوحة التحكم', 'icon' => 'dashboard'],
        ['route' => 'admin.communications', 'label' => 'الرسائل', 'icon' => 'inbox'],
        ['route' => 'admin.bookings', 'label' => 'الحجوزات', 'icon' => 'event_available'],
        ['route' => 'admin.services', 'label' => 'الخدمات', 'icon' => 'settings_suggest'],
        ['route' => 'admin.projects', 'label' => 'المشاريع', 'icon' => 'account_tree'],
        ['route' => 'admin.case-studies', 'label' => 'دراسات الحالة', 'icon' => 'analytics'],
        ['route' => 'admin.blog', 'label' => 'المدونة', 'icon' => 'article'],
        ['route' => 'admin.legal', 'label' => 'السياسات', 'icon' => 'gavel'],
        ['route' => 'admin.changelog', 'label' => 'سجل التغييرات', 'icon' => 'history'],
        ['route' => 'admin.settings', 'label' => 'الإعدادات', 'icon' => 'settings'],
    ],

    'dashboard' => [
        'title' => 'نظرة عامة',
        'description' => 'مؤشرات الأداء والتواصل لموقع A2Z Solutions.',
        'stats' => [
            ['icon' => 'group', 'label' => 'زوار الموقع', 'value' => '12,480', 'trend' => '+8.2%', 'accent' => 'primary'],
            ['icon' => 'inbox', 'label' => 'رسائل جديدة', 'value' => '8', 'trend' => '3 غير مقروءة', 'accent' => 'gold'],
            ['icon' => 'event_available', 'label' => 'حجوزات قادمة', 'value' => '5', 'trend' => 'خلال 7 أيام', 'accent' => 'primary'],
            ['icon' => 'star', 'label' => 'مشاريع مميزة', 'value' => '3', 'trend' => 'في الصفحة الرئيسية', 'accent' => 'gold'],
        ],
        'health' => [
            ['label' => 'حمل الخادم', 'value' => 32, 'note' => 'مستقر • آخر فحص: منذ دقيقتين'],
            ['label' => 'سعة التخزين', 'value' => 68, 'note' => 'استخدام طبيعي'],
            ['label' => 'زمن الاستجابة', 'value' => '42ms', 'note' => 'latency'],
        ],
        'promo' => [
            'title' => 'A2Z Solutions',
            'description' => 'منصة إدارة المحتوى — جاهزة للتوسع.',
            'button' => 'عرض الموقع',
            'href' => '/',
        ],
    ],

    'communications' => [
        'title' => 'رسائل المستخدمين',
        'description' => 'عرض وإدارة رسائل نموذج التواصل الواردة من الموقع.',
        'stats' => [
            ['label' => 'إجمالي الرسائل', 'value' => '24'],
            ['label' => 'غير مقروءة', 'value' => '3'],
            ['label' => 'قيد المتابعة', 'value' => '6'],
            ['label' => 'تم الرد', 'value' => '15'],
        ],
        'messages' => [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmad.client@example.com',
                'phone' => '+963991234567',
                'project_type' => 'تطوير مواقع وتطبيقات',
                'message' => 'نحتاج منصة حجز مواعيد طبية مع لوحة تحكم للأطباء. هل يمكن تقديم عرض سعر؟',
                'date' => '10 يوليو 2026 — 14:32',
                'status' => 'غير مقروءة',
                'status_variant' => 'gold',
            ],
            [
                'name' => 'سارة الحسن',
                'email' => 'sara@ngo.org',
                'phone' => '+963998765432',
                'project_type' => 'أنظمة ERP',
                'message' => 'جمعية غير ربحية تبحث عن نظام لإدارة المتطوعين والتبرعات مع تقارير دورية.',
                'date' => '9 يوليو 2026 — 10:15',
                'status' => 'قيد المتابعة',
                'status_variant' => 'primary',
            ],
            [
                'name' => 'محمد العلي',
                'email' => 'm.ali@shop.sy',
                'phone' => '+963993511111',
                'project_type' => 'متجر إلكتروني',
                'message' => 'أريد بناء متجر إلكتروني للملابس مع دفع إلكتروني وشحن محلي.',
                'date' => '8 يوليو 2026 — 16:48',
                'status' => 'تم الرد',
                'status_variant' => 'success',
            ],
            [
                'name' => 'فاطمة قاسم',
                'email' => 'fatima@academy.edu',
                'phone' => '+963994445566',
                'project_type' => 'تحليل النظم',
                'message' => 'أكاديمية تعليمية تحتاج منصة دورات مع اختبارات وشهادات. متى يمكن جلسة استشارة؟',
                'date' => '7 يوليو 2026 — 09:20',
                'status' => 'تم الرد',
                'status_variant' => 'success',
            ],
            [
                'name' => 'خالد إبراهيم',
                'email' => 'khaled@factory.sy',
                'phone' => '+963997778899',
                'project_type' => 'استضافة ونطاقات',
                'message' => 'نريد نقل 5 مواقع إلى استضافة آمنة مع نسخ احتياطي يومي.',
                'date' => '6 يوليو 2026 — 11:05',
                'status' => 'مؤرشف',
                'status_variant' => 'muted',
            ],
        ],
    ],

    'bookings' => [
        'title' => 'حجوزات الاستشارة',
        'description' => 'متابعة مواعيد حجز الاستشارة المجانية من صفحة التواصل.',
        'stats' => [
            ['label' => 'حجوزات اليوم', 'value' => '2'],
            ['label' => 'هذا الأسبوع', 'value' => '5'],
            ['label' => 'مؤكدة', 'value' => '4'],
            ['label' => 'بانتظار التأكيد', 'value' => '1'],
        ],
        'slots' => ['09:00 ص', '11:30 ص', '02:00 م', '04:30 م'],
        'booked_days' => ['2026-07-12', '2026-07-14', '2026-07-15', '2026-07-18'],
        'items' => [
            [
                'client' => 'أحمد محمد',
                'email' => 'ahmad.client@example.com',
                'phone' => '+963991234567',
                'date' => '12 يوليو 2026',
                'time' => '09:00 ص',
                'status' => 'مؤكد',
                'status_variant' => 'success',
                'note' => 'استشارة حول منصة حجز طبية',
            ],
            [
                'client' => 'سارة الحسن',
                'email' => 'sara@ngo.org',
                'phone' => '+963998765432',
                'date' => '14 يوليو 2026',
                'time' => '11:30 ص',
                'status' => 'مؤكد',
                'status_variant' => 'success',
                'note' => 'مناقشة نظام ERP للجمعيات',
            ],
            [
                'client' => 'محمد العلي',
                'email' => 'm.ali@shop.sy',
                'phone' => '+963993511111',
                'date' => '15 يوليو 2026',
                'time' => '02:00 م',
                'status' => 'بانتظار التأكيد',
                'status_variant' => 'gold',
                'note' => 'متجر إلكتروني — عرض أولي',
            ],
            [
                'client' => 'فاطمة قاسم',
                'email' => 'fatima@academy.edu',
                'phone' => '+963994445566',
                'date' => '18 يوليو 2026',
                'time' => '04:30 م',
                'status' => 'مؤكد',
                'status_variant' => 'success',
                'note' => 'منصة تعليمية تفاعلية',
            ],
        ],
    ],

    'services' => [
        'title' => 'إدارة الخدمات',
        'description' => 'تعديل ونشر خدمات A2Z Solutions المعروضة في الموقع.',
        'stats' => [
            ['label' => 'إجمالي الخدمات', 'value' => '6'],
            ['label' => 'منشورة', 'value' => '6'],
            ['label' => 'مسودات', 'value' => '0'],
            ['label' => 'معدل التوفر', 'value' => '99.9%'],
        ],
    ],

    'projects' => [
        'title' => 'إدارة المشاريع',
        'description' => 'متابعة المشاريع وتمييزها للعرض في الصفحة الرئيسية.',
        'filter_labels' => [
            'all' => 'الكل',
            'web-dev' => 'المواقع والتطبيقات',
            'erp' => 'ERP',
            'uiux' => 'UI/UX',
            'ecommerce' => 'متاجر إلكترونية',
            'hosting' => 'استضافة',
            'systems' => 'تحليل النظم',
        ],
        'completion_rate' => '87%',
        'completion_trend' => '+5.1%',
        'featured_limit' => 3,
    ],

    'case_studies' => [
        'title' => 'إدارة دراسات الحالة',
        'description' => 'تحرير دراسات الحالة مع اختيار التركيز: المشكلة أو الهدف.',
        'focus_options' => [
            'problem' => 'المشكلة + الحل التقني',
            'goal' => 'الهدف + ما قمنا به',
        ],
    ],

    'blog' => [
        'title' => 'إدارة المدونة',
        'description' => 'مقالات مركز المعرفة والتعليمات.',
        'stats' => [
            ['label' => 'مقالات منشورة', 'value' => '3'],
            ['label' => 'مسودات', 'value' => '1'],
            ['label' => 'أدلة تعليمية', 'value' => '4'],
            ['label' => 'مشاهدات الشهر', 'value' => '1,240'],
        ],
    ],

    'legal' => [
        'title' => 'السياسات والشروط',
        'description' => 'تحرير سياسة الخصوصية وشروط الخدمة وسياسة الكوكيز.',
    ],

    'changelog' => [
        'title' => 'سجل التغييرات',
        'description' => 'توثيق التحديثات والإصدارات في لوحة التحكم والموقع.',
        'items' => [
            [
                'version' => '1.4.0',
                'date' => '10 يوليو 2026',
                'type' => 'feature',
                'title' => 'إضافة أقسام الرسائل والحجوزات',
                'description' => 'واجهات إدارة رسائل التواصل وحجوزات الاستشارة مع تقويم تفاعلي.',
                'author' => 'Ahmad Qatea',
            ],
            [
                'version' => '1.3.0',
                'date' => '8 يوليو 2026',
                'type' => 'feature',
                'title' => 'دراسات الحالة مع خيار المشكلة/الهدف',
                'description' => 'دعم نوعين من عرض دراسة الحالة: المشكلة والحل التقني، أو الهدف وما تم إنجازه.',
                'author' => 'Ahmad Qatea',
            ],
            [
                'version' => '1.2.0',
                'date' => '5 يوليو 2026',
                'type' => 'feature',
                'title' => 'تمييز المشاريع للصفحة الرئيسية',
                'description' => 'إمكانية تحديد مشاريع مميزة تظهر في قسم المشاريع بالرئيسية.',
                'author' => 'Ahmad Qatea',
            ],
            [
                'version' => '1.1.0',
                'date' => '1 يوليو 2026',
                'type' => 'improvement',
                'title' => 'صفحات التواصل ومركز المعرفة',
                'description' => 'إطلاق صفحتي /contact و /knowledge مع حجز المواعيد والمدونة.',
                'author' => 'Ahmad Qatea',
            ],
            [
                'version' => '1.0.0',
                'date' => '20 يونيو 2026',
                'type' => 'release',
                'title' => 'الإطلاق الأول للوحة التحكم',
                'description' => 'لوحة تحكم A2Z CMS مع تسجيل دخول محلي وواجهات إدارة المحتوى.',
                'author' => 'Ahmad Qatea',
            ],
        ],
    ],

    'settings' => [
        'title' => 'إعدادات الموقع',
        'description' => 'الهوية البصرية، SEO، وبيانات التواصل العامة.',
        'sections' => [
            'brand' => 'الهوية البصرية',
            'contact' => 'بيانات التواصل',
            'seo' => 'تحسين محركات البحث',
            'social' => 'وسائل التواصل',
        ],
    ],

];
