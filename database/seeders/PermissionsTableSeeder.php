<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'client_create',
            ],
            [
                'id'    => 18,
                'title' => 'client_edit',
            ],
            [
                'id'    => 19,
                'title' => 'client_show',
            ],
            [
                'id'    => 20,
                'title' => 'client_delete',
            ],
            [
                'id'    => 21,
                'title' => 'client_access',
            ],
            [
                'id'    => 22,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 23,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 24,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 25,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 26,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 27,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 28,
                'title' => 'contract_create',
            ],
            [
                'id'    => 29,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 30,
                'title' => 'contract_show',
            ],
            [
                'id'    => 31,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 32,
                'title' => 'contract_access',
            ],
            [
                'id'    => 33,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 34,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 35,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 36,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 37,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 38,
                'title' => 'technician_create',
            ],
            [
                'id'    => 39,
                'title' => 'technician_edit',
            ],
            [
                'id'    => 40,
                'title' => 'technician_show',
            ],
            [
                'id'    => 41,
                'title' => 'technician_delete',
            ],
            [
                'id'    => 42,
                'title' => 'technician_access',
            ],
            [
                'id'    => 43,
                'title' => 'technician_type_create',
            ],
            [
                'id'    => 44,
                'title' => 'technician_type_edit',
            ],
            [
                'id'    => 45,
                'title' => 'technician_type_show',
            ],
            [
                'id'    => 46,
                'title' => 'technician_type_delete',
            ],
            [
                'id'    => 47,
                'title' => 'technician_type_access',
            ],
            [
                'id'    => 48,
                'title' => 'covenant_create',
            ],
            [
                'id'    => 49,
                'title' => 'covenant_edit',
            ],
            [
                'id'    => 50,
                'title' => 'covenant_show',
            ],
            [
                'id'    => 51,
                'title' => 'covenant_delete',
            ],
            [
                'id'    => 52,
                'title' => 'covenant_access',
            ],
            [
                'id'    => 53,
                'title' => 'technician_managment_access',
            ],
            [
                'id'    => 54,
                'title' => 'appointment_covenant_create',
            ],
            [
                'id'    => 55,
                'title' => 'appointment_covenant_edit',
            ],
            [
                'id'    => 56,
                'title' => 'appointment_covenant_show',
            ],
            [
                'id'    => 57,
                'title' => 'appointment_covenant_delete',
            ],
            [
                'id'    => 58,
                'title' => 'appointment_covenant_access',
            ],
            [
                'id'    => 59,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
