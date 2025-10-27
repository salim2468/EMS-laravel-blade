<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'manager', 'user'];

        $permissions = [
            'admin' => [
                'create_user',
                'edit_user',
                'delete_user',
                'approve_leave',
                'cancel_leave',
                'apply_user_leave'
            ],
            'manager' => [
                'approve_leave',
                'cancel_leave',
            ],
        ];

        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);
            $role->givePermissionTo($permissions[$role]);
        }
    }
}
