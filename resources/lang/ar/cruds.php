<?php

return [
    'userManagement' => [
        'title'          => 'إدارة الموظفين',
        'title_singular' => 'إدارة الموظفين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'الوظائف',
        'title_singular' => 'وظيفة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'وظيفة',
            'title_helper'       => ' ',
            'permissions'        => 'صلاحيات',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'الموظفين',
        'title_singular' => 'موظف',
        'fields'         => [
            'id'                              => 'ID',
            'id_helper'                       => ' ',
            'name'                            => 'الاسم',
            'name_helper'                     => ' ',
            'email'                           => 'البريد الالكتروني',
            'email_helper'                    => ' ',
            'email_verified_at'               => 'Email verified at',
            'email_verified_at_helper'        => ' ',
            'password'                        => 'كلمة السر',
            'password_helper'                 => ' ',
            'roles'                           => 'الوظائف',
            'roles_helper'                    => ' ',
            'remember_token'                  => 'Remember Token',
            'remember_token_helper'           => ' ',
            'created_at'                      => 'Created at',
            'created_at_helper'               => ' ',
            'updated_at'                      => 'Updated at',
            'updated_at_helper'               => ' ',
            'deleted_at'                      => 'Deleted at',
            'deleted_at_helper'               => ' ',
            'phone'                           => 'رقم الهاتف',
            'phone_helper'                    => ' ',
            'nationality'                     => 'الجنسية',
            'nationality_helper'              => ' ',
            'user_type'                       => 'User Type',
            'user_type_helper'                => ' ',
            'photo'                           => 'الصورة',
            'photo_helper'                    => ' ',
            'identity_num'                    => 'رقم الهوية',
            'identity_num_helper'             => ' ',
            'contract_type'                   => 'التعاقد',
            'contract_type_helper'            => ' ',
            'job_num'                         => 'الرقم الوظيفي',
            'job_num_helper'                  => ' ',
            'company_name'                    => 'اسم الشركة/المؤسسة',
            'company_name_helper'             => ' ',
            'company_field'                   => 'النشاط',
            'company_field_helper'            => ' ',
            'commerical_num'                  => 'رقم السجل',
            'commerical_num_helper'           => ' ',
            'commerical_image'                => 'صورة السجل',
            'commerical_image_helper'         => ' ',
            'manager_name'                    => 'اسم المدير العام',
            'manager_name_helper'             => ' ',
            'manager_phone'                   => 'الجوال',
            'manager_phone_helper'            => ' ',
            'manager_email'                   => 'البريد الألكتروني',
            'manager_email_helper'            => ' ',
            'company_address'                 => 'العنوان والمدينة',
            'company_address_helper'          => ' ',
            'company_website'                 => 'الموقع الألكتروني للشركة',
            'company_website_helper'          => ' ',
            'contract_by'                     => 'صفة التعاقد',
            'contract_by_helper'              => ' ',
            'contract_image'                  => 'صورة العقد',
            'contract_image_helper'           => ' ',
            'contract_start'                  => 'بداية العقد',
            'contract_start_helper'           => ' ',
            'contract_end'                    => 'نهاية العقد',
            'contract_end_helper'             => ' ',
            'commissioner_name'               => 'الاسم الرباعي',
            'commissioner_name_helper'        => ' ',
            'commissioner_nationality'        => 'الجنسية',
            'commissioner_nationality_helper' => ' ',
            'commissioner_id_number'          => 'رقم الهوية',
            'commissioner_id_number_helper'   => ' ',
            'commissioner_id_image'           => 'صورة الهوية',
            'commissioner_id_image_helper'    => ' ',
            'commissioner_id_start'           => 'تاريخ الأصدار',
            'commissioner_id_start_helper'    => ' ',
            'commissioner_id_end'             => 'تاريخ الأنتهاء',
            'commissioner_id_end_helper'      => ' ',
            'commissioner_job'                => 'المسمي الوظيفي',
            'commissioner_job_helper'         => ' ',
            'commissioner_image'              => 'صورة خطاب التكليف',
            'commissioner_image_helper'       => ' ',
            'commissioner_phone'              => 'رقم الهاتف',
            'commissioner_phone_helper'       => ' ',
            'commissioner_email'              => 'البريد الألكتروني',
            'commissioner_email_helper'       => ' ',
        ],
    ],
    'client' => [
        'title'          => 'العملاء',
        'title_singular' => 'عميل',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'العميل',
            'user_helper'       => ' ',
            'address'           => 'العنوان',
            'address_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'تنبيهات الموظفين',
        'title_singular' => 'تنبيه',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'التنبيه',
            'alert_text_helper' => ' ',
            'alert_link'        => 'الرابط',
            'alert_link_helper' => ' ',
            'user'              => 'الموظفين',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'contract' => [
        'title'          => 'العقود',
        'title_singular' => 'عقد',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'client'               => 'العميل',
            'client_helper'        => ' ',
            'start_date'           => 'تاريخ البداية',
            'start_date_helper'    => ' ',
            'end_date'             => 'تاريخ النهاية',
            'end_date_helper'      => ' ',
            'num_of_visits'        => 'عدد الزيارات',
            'num_of_visits_helper' => ' ',
            'services'             => 'الخدمات',
            'services_helper'      => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'appointment' => [
        'title'          => 'المواعيد',
        'title_singular' => 'موعد',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'date'                       => 'التاريخ',
            'date_helper'                => ' ',
            'time'                       => 'الوقت',
            'time_helper'                => ' ',
            'status'                     => 'الحالة',
            'status_helper'              => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'contract'                   => 'العقد',
            'contract_helper'            => ' ',
            'client'                     => 'العميل',
            'client_helper'              => ' ',
            'type'                       => 'النوع',
            'type_helper'                => ' ',
            'technician'                 => 'الفنيين',
            'technician_helper'          => ' ',
            'finish_code'                => 'كود النتهاء',
            'finish_code_helper'         => ' ',
            'review'                     => 'التقييم',
            'review_helper'              => ' ',
            'problem_description'        => 'وصف المشكلة',
            'problem_description_helper' => ' ',
            'problem_photos'             => 'صور المشكلة',
            'problem_photos_helper'      => ' ',
            'problem_description_by_tech'        => 'وصف المشكلة من قبل الفني',
            'problem_description_by_tech_helper' => ' ',
            'problem_photos_by_tech'             => 'صور المشكلة من قبل الفني',
            'problem_photos_by_tech_helper'      => ' ',
            'cancel_reason'              => 'سبب الألغاء',
            'cancel_reason_helper'       => ' ',
            'arrived_lat'                => 'Arrived Lat',
            'arrived_lat_helper'         => ' ',
            'arrived_lng'                => 'Arrived Lng',
            'arrived_lng_helper'         => ' ',
        ],
    ],
    'technician' => [
        'title'          => 'الفنيين',
        'title_singular' => 'فني',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'user'                   => 'الفني',
            'user_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'technician_type'        => 'نوع الفني',
            'technician_type_helper' => ' ',
            'identity_num'           => 'رقم الهوية',
            'identity_num_helper'    => ' ',
        ],
    ],
    'technicianType' => [
        'title'          => 'انواع الفنيين',
        'title_singular' => 'نوع فني',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'النوع',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'covenant' => [
        'title'          => 'العهدات',
        'title_singular' => 'عهدة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'technician'         => 'الفني',
            'technician_helper'  => ' ',
            'name'               => 'العهدة',
            'name_helper'        => ' ',
            'description'        => 'الوصف',
            'description_helper' => ' ',
            'price'              => 'السعر',
            'price_helper'       => ' ',
            'quantity'           => 'الكمية',
            'quantity_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'technicianManagment' => [
        'title'          => 'إدارة الفنيين',
        'title_singular' => 'إدارة الفنيين',
    ],
    'appointmentCovenant' => [
        'title'          => 'العهدات المصروفة',
        'title_singular' => 'عهدة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'appointment'        => 'المعاد',
            'appointment_helper' => ' ',
            'covenant'           => 'العهدة',
            'covenant_helper'    => ' ',
            'quantity'           => 'الكمية',
            'quantity_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

    'slider' => [
        'title'          => 'سلايدرز',
        'title_singular' => 'سلايدر',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'image'             => 'الصورة',
            'image_helper'      => ' ',
            'publish'           => 'النشر',
            'publish_helper'    => ' ',
            'text'              => 'العنوان',
            'text_helper'       => ' ',
            'link'              => 'الرابط',
            'link_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];