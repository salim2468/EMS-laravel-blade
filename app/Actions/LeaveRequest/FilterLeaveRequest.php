<?php

namespace App\Actions\LeaveRequest;

use App\Models\LeaveRequest;
use Illuminate\Support\Arr;

class FilterLeaveRequest
{
    protected $query;

    public function __construct(LeaveRequest $leaveBalance)
    {
        $this->query = $leaveBalance->query();
    }
    /**
     * @param  array  $params
     */
    public function execute(array $params = [])
    {
        if ($userId = Arr::pull($params, 'user_id')) {
            $this->query->where('user_id', $userId);
        }

        if ($approvedById = Arr::pull($params, 'approved_by_id')) {
            $this->query->where('approved_by_id', $approvedById);
        }

        if ($fromDate = Arr::pull($params, 'fromDate')) {
            $this->query->whereDate('start_date', '>=', $fromDate);
        }

        if ($toDate = Arr::pull($params, 'toDate')) {
            $this->query->whereDate('end_date', '<=', $toDate);
        }

        return $this->query;
    }
}
