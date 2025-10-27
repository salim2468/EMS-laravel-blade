<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class CreatePermission
{
    /**
     * @param  array  $inputs
     */
    public function execute(array $inputs)
    {
        $permission = Permission::create($inputs);
        
        return $permission;
    }
}
