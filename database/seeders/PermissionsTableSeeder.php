<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $i = 1;

        $permissions = [
            [
                'id'    => $i++,
                'title' => 'user_management_access',
                'type'  => 'role.user.user_alert',
                'parent' => 1,
            ],
            [
                'id'    => $i++,
                'title' => 'permission_create',
                'type'  => 'permission',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'permission_edit',
                'type'  => 'permission',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'permission_show',
                'type'  => 'permission',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'permission_delete',
                'type'  => 'permission',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'permission_access',
                'type'  => 'permission',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'role_create',
                'type'  => 'role',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'role_edit',
                'type'  => 'role',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'role_show',
                'type'  => 'role',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'role_delete',
                'type'  => 'role',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'role_access',
                'type'  => 'role',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_create',
                'type'  => 'user',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_edit',
                'type'  => 'user',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_show',
                'type'  => 'user',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_delete',
                'type'  => 'user',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_access',
                'type'  => 'user',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'client_create',
                'type'  => 'client',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'client_edit',
                'type'  => 'client',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'client_show',
                'type'  => 'client',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'client_delete',
                'type'  => 'client',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'client_access',
                'type'  => 'client',
                'parent' => 2,
            ],
            // [
            //     'id'    => $i++,
            //     'title' => 'audit_log_show',
            //     'type'  => 'audit_log',
            //     'parent' => 0,
            // ],
            // [
            //     'id'    => $i++,
            //     'title' => 'audit_log_access',
            //     'type'  => 'audit_log',
            //     'parent' => 0,
            // ],
            [
                'id'    => $i++,
                'title' => 'user_alert_create',
                'type'  => 'user_alert',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_alert_show',
                'type'  => 'user_alert',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_alert_delete',
                'type'  => 'user_alert',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'user_alert_access',
                'type'  => 'user_alert',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'contract_create',
                'type'  => 'contract',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'contract_edit',
                'type'  => 'contract',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'contract_show',
                'type'  => 'contract',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'contract_delete',
                'type'  => 'contract',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'contract_access',
                'type'  => 'contract',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_create',
                'type'  => 'appointment',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_edit',
                'type'  => 'appointment',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_show',
                'type'  => 'appointment',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_delete',
                'type'  => 'appointment',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_access',
                'type'  => 'appointment',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_create',
                'type'  => 'technician',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_edit',
                'type'  => 'technician',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_show',
                'type'  => 'technician',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_delete',
                'type'  => 'technician',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_access',
                'type'  => 'technician',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_type_create',
                'type'  => 'technician_type',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_type_edit',
                'type'  => 'technician_type',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_type_show',
                'type'  => 'technician_type',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_type_delete',
                'type'  => 'technician_type',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_type_access',
                'type'  => 'technician_type',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'covenant_create',
                'type'  => 'covenant',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'covenant_edit',
                'type'  => 'covenant',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'covenant_show',
                'type'  => 'covenant',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'covenant_delete',
                'type'  => 'covenant',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'covenant_access',
                'type'  => 'covenant',
                'parent' => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'technician_managment_access',
                'type'  => 'technician.technician_type.covenant',
                'parent' => 1,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_covenant_create',
                'type'  => 'appointment_covenant',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_covenant_edit',
                'type'  => 'appointment_covenant',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_covenant_show',
                'type'  => 'appointment_covenant',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_covenant_delete',
                'type'  => 'appointment_covenant',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'appointment_covenant_access',
                'type'  => 'appointment_covenant',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'slider_create',
                'type'  => 'slider',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'slider_edit',
                'type'  => 'slider',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'slider_show',
                'type'  => 'slider',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'slider_delete',
                'type'  => 'slider',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'slider_access',
                'type'  => 'slider',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'profile_password_edit',
                'type'  => 'general',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'dashboard_stats',
                'type'  => 'general',
                'parent' => 2,
            ],
            [
                'id'    => $i++,
                'title' => 'property_type_create',
                'type'  => 'property_type',
                'parent'  => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'property_type_edit',
                'type'  => 'property_type',
                'parent'  => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'property_type_show',
                'type'  => 'property_type',
                'parent'  => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'property_type_delete',
                'type'  => 'property_type',
                'parent'  => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'property_type_access',
                'type'  => 'property_type',
                'parent'  => 0,
            ],
            [
                'id'    => $i++,
                'title' => 'client_managment_access',
                'type'  => 'property_type.client',
                'parent'  => 1,
            ],
        ];

        Permission::insert($permissions);
    }
}
