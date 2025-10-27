<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class CreateRole
{
    /**
     * @param  array  $inputs
     */
    public function execute(array $inputs)
    {
        $role = Role::create($inputs);

        return $role;
    }
}
