<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class UpdatePermission
{
    /**
     * @param  Permission  $permission
     * @param  array  $inputs
     */
    public function execute(Permission $permission, array $inputs)
    {
      $updatePermission = $permission->update($inputs);
      
      return $updatePermission;
    }
}
