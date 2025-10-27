<?php

namespace App\Actions\LeaveType;

use App\Models\LeaveType;

class CreateLeaveType
{
    /**
     * @param  array  $inputs
     */
    public function execute(array $inputs)
    {
        $leaveType = LeaveType::create($inputs);

        return $leaveType;
    }
}
