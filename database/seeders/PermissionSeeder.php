<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['create_user', 'edit_user', 'delete_user',
            'approve_leave', 'cancel_leave', 'apply_user_leave'];

        foreach ($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }
    }
}
