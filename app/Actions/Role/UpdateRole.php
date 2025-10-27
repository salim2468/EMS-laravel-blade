<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class UpdateRole
{
    /**
     * @param  Role  $role
     * @param  array  $inputs
     */
    public function execute(Role $role, array $inputs)
    {
        $role->update($inputs);
    }
}
