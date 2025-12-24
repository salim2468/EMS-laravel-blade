<?php

namespace App\Actions\Leave;

use Exception;
use App\Models\Leave;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ForceRejectLeave
{
    public function execute(LeaveRequest $leaveRequest)
    {
        $user = auth()->user();

        if ($leaveRequest->user->manager_id !== $user->id) {
            throw new \Exception('Unauthorized: You are not the manager of this user.');
        }

        if ($leaveRequest->status !== strtolower(Leave::LEAVE_STATUS_APPROVED)) {
            throw new \Exception('Cannot force reject of unapproved leave');
        }
        try {
            DB::beginTransaction();
            $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->user_id)->where('leave_type_id', $leaveRequest->leave_type_id)->first();
            $leaveBalance->used_days = $leaveBalance->used_days - 1;
            $leaveBalance->save();
            $leaveRequest->status = Leave::LEAVE_STATUS_FORCED_REJECTED;
            $leaveRequest->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Forced Reject leave failed', ['message' => $e->getMessage()]);
            throw new Exception('Error while Forece Rejecting Leave: ' . $e->getMessage());
        }
    }
}
