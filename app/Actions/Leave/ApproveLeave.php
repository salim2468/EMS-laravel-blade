<?php

namespace App\Actions\Leave;

use Exception;
use App\Models\Leave;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApproveLeave
{
    public function execute(LeaveRequest $leaveRequest)
    {

        try {
            $user = auth()->user();

            if ($leaveRequest->user->manager_id !== $user->id) {
                throw new \Exception('Unauthorized: You are not the manager of this user.');
            }

            DB::beginTransaction();
            $leaveRequest->status = Leave::LEAVE_STATUS_APPROVED;
            $leaveRequest->approved_by_id = $user->id;
            $leaveRequest->save();

            $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->user_id)->where('leave_type_id', $leaveRequest->leave_type_id)->first();
            if (!$leaveBalance) {
                throw new \Exception('Leave balance not found.');
            }
            $leaveBalance->total_days = $leaveBalance->total_days - $leaveRequest->count;
            $leaveBalance->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Apply leave failed', ['message' => $e->getMessage()]);
            throw new Exception('Error while Applying Leave: ' . $e->getMessage());
        }
    }
}
