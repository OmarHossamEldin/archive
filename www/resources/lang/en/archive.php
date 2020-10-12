<?php


return [
    'global' => [
        'search' => 'Search',
        'organization' => 'Organization',
        'subject' => 'Subject',
        'suitcase' => 'Suitcase',
        'operation' => 'Operation',
        'type' => 'Type',
        'not_available' => 'Not Available',
        'edit' => 'Edit',
        'backupop' => 'Backup',
        'login' => [
            'success' => 'Logged in Successfully',
            'error' => 'Password is not correct'
        ],
        'logout' => 'Logged out Successfully',
        'logout_btn' => 'Logout '

    ],
    'backup' => [
        'restore_button_title' => 'Restore',
        'backup_button_title' => 'Backup',
        'restore_title' => 'Select a previously backed up file',
        'backup_title' => 'Choose a folder to save a backup'
    ],
    'app' => [
        'name' => 'Archive',
        'version' => 'Version 1.0',
    ],
    'copyright' => 'Copyrights reserved to',
    'login' => [
        'button' => 'Continue',
        'header' => 'Login',
        'forget' => 'Forgot your password?'
    ],

    'sidebar' => [
        'document' => 'Documents',
        'organization' => 'Organizations',
        'subject' => 'Subjects',
        'suitcase' => 'Suitcases'
    ],
    'document' => [
        'title' => 'Document',
        'button_title' => "Add",
        'submenus' => [
            'create' => 'Add Document',
            'index' => 'All Documents'
        ],
        'create' => [
            'submenu_title' => 'Add Document',
            'serial' => 'Serial No.',
            'type' => [
                'title' => 'Type',
                'import' => 'Imported',
                'export' => 'Exported'
            ],
            'description' => 'Description',
            'date' => 'Date',
            'organization' => 'Organization',
            'file' => 'Choose file',
            'active_suitcase' => 'Active Suitcase'
        ],
        'edit' => [
            'submenu_title' => 'Edit Document',
            'file' => 'Attached File',
            'current_suitcase' => 'Current Suitcase',
            'active_suitcase' => 'Active Suitcase',
            'active_suitcase_caution' => 'The active suitcase will be automatically choosed'

        ],
        'success' => [
            'add' => 'A new document hase beed added successfully',
            'delete' => 'The document has been removed successfully',
            'edit' => 'The document has been modified successfully'
        ],
        'fail' => [
            'add' => 'An error has occured during adding the document, please check your data',
            'delete' => 'An error has occured during deleting the document',
            'edit' => 'An error has occured during modifing the document',
            'download' => 'There is no attached file with this document'
        ]
    ],
    'organization' => [
        'title' => 'Organization',
        'button_title' => "Add",
        'submenus' => [
            'create' => 'Add Organization',
            'index' => 'All Organizations'
        ],
        'create' => [
            'submenu_title' => 'Add Organization',
            'organization' => 'Organization',
            'parent_organization' => 'Parent Organization'
        ],
        'index' => [
            'id' => 'Serial',
            'organization' => 'Name',
            'parent_organization' => 'Parent Organization',
        ],
        'edit' => [
            'submenu_title' => 'Edit Organization',
        ],
        'success' => [
            'add' => 'The organization has beed added successfully',
            'edit' => 'The organization has beed modified successfully',
            'delete' => 'The organization has beed deleted successfully'
        ],
        'fail' => [
            'delete' => 'Error!',
            'edit' => 'Error!'
        ]

    ],
    'subject' => [
        'title' => 'Subject',
        'button_title' => "Add",
        'submenus' => [
            'create' => 'Add Subject',
            'index' => 'All Subjects'
        ],
        'create' => [
            'submenu_title' => 'Add Subject',
            'subject' => 'Subject'
        ],
        'edit' => [
            'submenu_title' => 'Edit Subject'
        ],
        'index' => [
            'id' => 'Serial',
            'subject' => 'Name'
        ],
        "success" => [
            'add' => 'The subject has beed added successfully',
            'delete' => 'The subject has beed deleted successfully',
            'edit' => 'The subject has beed modified successfully'
        ],
        'fail' => [
            'add' => 'There was an error while adding the subject',
            'delete' => 'There was an error while deleting the subject, ensure that there are no associated documents',
            'edit' => 'There was an error while editing the subject'
        ]


    ],
    'suitcase' => [
        'title' => 'Suitcase',
        'button_title' => "Add",
        'submenus' => [
            'create' => 'Add Suitcase',
            'index' => 'All Suitcases'
        ],
        'active' => [
            'not_available' => 'There is no activated suitcase, please activate one'
        ],
        'create' => [
            'submenu_title' => 'Add Suitcase',
            'name' => 'Suitcase',
            'send_date' => 'Send Date',
            'airline' => 'Airline',
            'weight' => 'Weight',
            'comment' => 'Notes',
            'current_flag' => 'Activated',
            'name_caution' => 'CAUTION: please ensure that the suitcase name does not contain any of the following symbols: "\.\\\?؟"'
        ],
        'edit' => [
            'submenu_title' => 'تعديل حقيبة',
        ],
        'success' => [
            'add' => 'لقد تم إضافة الحقيبة بنجاح',
            'delete' => 'لقد تم مسح الحقيبة بنجاح',
            'edit' => 'لقد تم تعديل الحقيبة بنجاح'
        ],
        'fail' => [
            'add' => 'لقد كان هناك خطأ خلال إضافة الحقيبة',
            'delete' => 'لقد كان هناك خطأ خلال مسح الحقيبة',
            'edit' => 'لقد كان هناك خطأ اثناء تعديل الحقيبة'
        ]
    ]
];
