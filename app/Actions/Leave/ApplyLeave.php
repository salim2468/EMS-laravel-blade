<?php

namespace App\Actions\Leave;

use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplyLeave
{
    public function execute(array $inputs)
    {
        $count = 0;
        try {
            switch ($inputs['day_type']) {
                case LeaveType::LEAVE_DAY_TYPE_HALF:
                    $count = 0.5;
                    $inputs['end_date'] = $inputs['start_date'];
                    break;
                case LeaveType::LEAVE_DAY_TYPE_SINGLE:
                    $count = 1;
                    $inputs['end_date'] = $inputs['start_date'];
                    Log::debug($inputs['end_date']);
                    break;
                case LeaveType::LEAVE_DAY_TYPE_MULTIPLE:
                    $inputs['start_date'] = Carbon::parse($inputs['start_date']);
                    $inputs['end_date'] = Carbon::parse($inputs['end_date']);
                    $count    = $inputs['start_date']->diffInDays($inputs['end_date']) + 1;
                    break;
            }
            $this->checkLeaveDateConflict($inputs['start_date'], $inputs['end_date']);

            $inputs['count'] = $count;
            $user = auth()->user();
            $inputs['approved_by_id'] = $user->manager_id ?? 4;
            $inputs['user_id'] = $user->id;

            DB::beginTransaction();
            // reduce leave from leave balance table
            $leaveBalance = LeaveBalance::where('user_id', $user->id)
                ->where('leave_type_id', $inputs['leave_type_id'])->first();
            if (!$leaveBalance) {
                throw new \Exception('Leave balance not found for this user and leave type.');
            }

            if (($leaveBalance->total_days) < $count) {
                throw new \Exception('Insufficient Leave');
            }
            LeaveRequest::create($inputs);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Apply leave failed', ['message' => $e->getMessage()]);
            throw new Exception('Error while Applying Leave: ' . $e->getMessage());
        }
    }
    private function checkLeaveDateConflict($startDate, $endDate)
    {
        $user = auth()->user();
        $hasConflict = LeaveRequest::where('user_id', $user->id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })->exists();

        if ($hasConflict) {
            throw new \Exception('You have already applied for leave during the selected date range.');
        }
    }
}
