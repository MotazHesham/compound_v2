<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
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
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
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
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'user_type'                => 'User Type',
            'user_type_helper'         => ' ',
        ],
    ],
    'client' => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'address'           => 'Address',
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
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'contract' => [
        'title'          => 'Contracts',
        'title_singular' => 'Contract',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'client'               => 'Client',
            'client_helper'        => ' ',
            'start_date'           => 'Start Date',
            'start_date_helper'    => ' ',
            'end_date'             => 'End Date',
            'end_date_helper'      => ' ',
            'num_of_visits'        => 'Num Of Visits',
            'num_of_visits_helper' => ' ',
            'services'             => 'Services',
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
        'title'          => 'Appointments',
        'title_singular' => 'Appointment',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'date'                       => 'Date',
            'date_helper'                => ' ',
            'time'                       => 'Time',
            'time_helper'                => ' ',
            'status'                     => 'Status',
            'status_helper'              => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'contract'                   => 'Contract',
            'contract_helper'            => ' ',
            'client'                     => 'Client',
            'client_helper'              => ' ',
            'type'                       => 'Type',
            'type_helper'                => ' ',
            'technician'                 => 'Technician',
            'technician_helper'          => ' ',
            'finish_code'                => 'Finish Code',
            'finish_code_helper'         => ' ',
            'review'                     => 'Review',
            'review_helper'              => ' ',
            'problem_description'        => 'Problem Description',
            'problem_description_helper' => ' ',
            'problem_photos'             => 'Problem Photos',
            'problem_photos_helper'      => ' ',
            'cancel_reason'              => 'Cancel Reason',
            'cancel_reason_helper'       => ' ',
            'arrived_lat'                => 'Arrived Lat',
            'arrived_lat_helper'         => ' ',
            'arrived_lng'                => 'Arrived Lng',
            'arrived_lng_helper'         => ' ',
        ],
    ],
    'technician' => [
        'title'          => 'Technicians',
        'title_singular' => 'Technician',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'user'                   => 'User',
            'user_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'technician_type'        => 'Technician Type',
            'technician_type_helper' => ' ',
            'identity_num'           => 'Identity Num',
            'identity_num_helper'    => ' ',
        ],
    ],
    'technicianType' => [
        'title'          => 'Technician Types',
        'title_singular' => 'Technician Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
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
        'title'          => 'Covenants',
        'title_singular' => 'Covenant',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'technician'         => 'Technician',
            'technician_helper'  => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'quantity'           => 'Quantity',
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
        'title'          => 'Technician Managment',
        'title_singular' => 'Technician Managment',
    ],
    'appointmentCovenant' => [
        'title'          => 'Appointment Covenants',
        'title_singular' => 'Appointment Covenant',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'appointment'        => 'Appointment',
            'appointment_helper' => ' ',
            'covenant'           => 'Covenant',
            'covenant_helper'    => ' ',
            'quantity'           => 'Quantity',
            'quantity_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
