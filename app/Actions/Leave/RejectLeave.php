<?php

namespace App\Actions\Leave;

use App\Models\Leave;
use App\Models\LeaveRequest;

class RejectLeave
{
    public function execute(LeaveRequest $leaveRequest)
    {
        $user = auth()->user();

        if ($leaveRequest->user->manager_id !== $user->id) {
            throw new \Exception('Unauthorized: You are not the manager of this user.');
        }

        $leaveRequest->status = Leave::LEAVE_STATUS_REJECTED;
        $leaveRequest->save();
    }
}
