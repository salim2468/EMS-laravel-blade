<?php

namespace App\Actions\LeaveType;

use App\Models\LeaveType;

class DeleteLeaveType
{
    /**
     * @param  LeaveType  $leaveType
     * @param  array  $inputs
     */
    public function execute(LeaveType $leaveType)
    {
        $leaveType->delete();
    }
}
