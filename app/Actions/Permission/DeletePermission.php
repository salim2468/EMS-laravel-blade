<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class DeletePermission
{
     /**
     * @param  Permission  $permission
     */
    public function execute(Permission $permission) {
        $permission->delete();
    }
}
