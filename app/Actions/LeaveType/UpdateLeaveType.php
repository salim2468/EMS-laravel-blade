<?php

namespace App\Actions\LeaveType;

use App\Models\LeaveType;

class UpdateLeaveType
{
    /**
     * @param  Role  $role
     * @param  array  $inputs
     */
    public function execute(LeaveType $role, array $inputs)
    {
        $role->update($inputs);
    }
}
