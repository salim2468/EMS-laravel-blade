<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class LeaveController
{
    /**
     * @param  Role  $role
     * @param  array  $inputs
     */
    public function execute(Role $role)
    {
        $role->delete();
    }
}
