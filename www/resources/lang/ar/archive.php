<?php


return [
    'global' => [
        'search' => 'بحث',
        'organization' => 'الجهة',
        'subject' => 'الموضوع الرئيسي',
        'suitcase' => 'الحقيبة',
        'operation' => 'العمليات',
        'type' => 'الحالة',
        'not_available' => 'لا يوجد',
        'edit' => 'تعديل',
        'backupop' => 'عمليات النسخه الاحتياطية',
        'login' => [
            'success' => 'لقد تم تسجيل الدخول بنجاح',
            'error' => 'برجاء التأكد من كلمة المرور'
        ],
        'logout' => 'لقد تم تسجيل الخروج بنجاح',
        'logout_btn' => 'تسجيل الخروج '

    ],
    'backup' => [
        'restore_button_title' => 'إعادة النسخة',
        'backup_button_title' => 'استخراج نسخة',
        'restore_title' => 'اختر ملف إعادة البيانات المُستخرج سابقاً',
        'backup_title' => 'اختر مكان لحفظ ملف البيانات الحالي'
    ],
    'app' => [
        'name' => 'برنامج الأرشيف',
        'version' => '1.1 إصدار',
    ],
    'copyright' => 'This program is made with love for Gen. Khalid Mosbah',
    'login' => [
        'button' => 'متابعة',
        'header' => 'تسجيل الدخول',
        'forget' => 'لقد نسيت كلمة المرور'
    ],

    'sidebar' => [
        'document' => 'المكاتبات',
        'organization' => 'الجهات',
        'subject' => 'الموضوعات الرئيسية',
        'suitcase' => 'الحقائب'
    ],
    'document' => [
        'title' => 'مكاتبة',
        'button_title' => "إضافة",
        'submenus' => [
            'create' => 'إضافة مكاتبة',
            'index' => 'جميع المكاتبات'
        ],
        'index' => [
            'downloadSuitcase' => 'تحميل كل المكاتبات للحقيبة'
        ],
        'create' => [
            'submenu_title' => 'إضافة مكاتبة',
            'serial' => 'رقم المسلسل',
            'type' => [
                'title' => 'النوع',
                'import' => 'وارد',
                'export' => 'صادر'
            ],
            'description' => 'اسم المكاتبة',
            'date' => 'التاريخ',
            'organization' => 'الجهة',
            'file' => 'اختر الملف',
            'active_suitcase' => 'الحقيبة المُفعلة'
        ],
        'edit' => [
            'submenu_title' => 'تعديل مكاتبة',
            'file' => 'الملف المُدرج',
            'current_suitcase' => 'الحقيبة الحالية',
            'active_suitcase' => 'الحقيبة المُفعلة',
            'active_suitcase_caution' => 'برجى العلم أنه اذا كانت الحقيبة الحالية لا تساوي الحقيبة المُفعلة سوف يتم اختيار الحقيبة المُفعلة بشكل تلقائي'

        ],
        'success' => [
            'add' => 'لقد تم إضافة مكاتبة بنجاح',
            'delete' => 'لقد تم إزالة المكاتبة بنجاح',
            'edit' => 'لقد تم تعديل المكاتبة بنجاح'
        ],
        'fail' => [
            'add' => 'لقد كان هناك خطأ خلال إضافة المكاتبة من فضلك تأكد من صحة البيانات',
            'delete' => 'لقد كان هناك خطأ خلال إزالة المكاتبة',
            'edit' => 'لقد كان هناك خطأ خلال تعديل المكاتبة',
            'download' => 'لا يوجد ملف مٌرفق مع هذه المكاتبة'
        ]
    ],
    'organization' => [
        'title' => 'جهة',
        'button_title' => "إضافة",
        'submenus' => [
            'create' => 'إضافة جهة',
            'index' => 'جميع الجهات'
        ],
        'create' => [
            'submenu_title' => 'إضافة الجهة',
            'organization' => 'الجهة',
            'parent_organization' => 'الجهة الأم'
        ],
        'index' => [
            'id' => 'المسلسل',
            'organization' => 'الأسم',
            'parent_organization' => 'الجهة الأم',
        ],
        'edit' => [
            'submenu_title' => 'تعديل الجهة',
        ],
        'success' => [
            'add' => 'لقد تم إضافة جهة بنجاح',
            'edit' => 'لقد تم تعديل الجهة بنجاح',
            'delete' => 'لفد تم حذف الجهة بنجاح'
        ],
        'fail' => [
            'delete' => 'لقد كان هناك خطأ خلال حذف الجهة، برجاءاختيار جهة أخرى',
            'edit' => 'لقد كان هناك خطأ خلال تعديل الجهة، برجاء التأكد من صحة البيانات'
        ]

    ],
    'subject' => [
        'title' => 'موضوع',
        'button_title' => "إضافة",
        'submenus' => [
            'create' => 'إضافة موضوع',
            'index' => 'جميع الموضوعات'
        ],
        'create' => [
            'submenu_title' => 'إضافة موضوع',
            'subject' => 'الموضوع'
        ],
        'edit' => [
            'submenu_title' => 'تعديل الموضوع'
        ],
        'index' => [
            'id' => 'المسلسل',
            'subject' => 'الأسم'
        ],
        "success" => [
            'add' => 'لقد تم إضافة موضوع بنجاح',
            'delete' => 'لقد تم حذف الموضوع بنجاح',
            'edit' => 'لقد تم تعديل الموضوع بنجاح'
        ],
        'fail' => [
            'add' => 'لقد كان هناك خطأ خلال إضافة الموضوع',
            'delete' => 'لقد كان هناك خطأ خلال إزالة الموضوع، من فضلك تأكد من عدم وجود مكاتبات مرتبطة',
            'edit' => 'لقد كان هناك خطأ خلال تعديل الموضوع'
        ]


    ],
    'suitcase' => [
        'title' => 'حقيبة',
        'button_title' => "إضافة",
        'submenus' => [
            'create' => 'إضافة حقيبة',
            'index' => 'جميع الحقائب'
        ],
        'active' => [
            'not_available' => 'لا توجد حقيبة مُفعلة، من فضلك اضف واحدة'
        ],
        'create' => [
            'submenu_title' => 'إضافة حقيبة',
            'name' => 'حقيبة',
            'send_date' => 'تاريخ الإرسال',
            'airline' => 'خط الطيران',
            'weight' => 'الوزن',
            'comment' => 'الملاحظات',
            'current_flag' => 'مُفعلة',
            'name_caution' => 'تنويه: غيرم مسموح بوجود الرموز الآتية بأسم الحقيبة: "\.\\\?؟"'
        ],
        'edit' => [
            'submenu_title' => 'تعديل حقيبة',
        ],
        'success' => [
            'add' => 'لقد تم إضافة الحقيبة بنجاح',
            'delete' => 'لقد تم حذف الحقيبة بنجاح',
            'edit' => 'لقد تم تعديل الحقيبة بنجاح'
        ],
        'fail' => [
            'add' => 'لقد كان هناك خطأ خلال إضافة الحقيبة',
            'delete' => 'لقد كان هناك خطأ خلال حذف الحقيبة',
            'edit' => 'لقد كان هناك خطأ اثناء تعديل الحقيبة'
        ]
    ]
];
