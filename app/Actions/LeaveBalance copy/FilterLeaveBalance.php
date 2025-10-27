<?php

namespace App\Actions\LeaveBalance;

use App\Models\LeaveBalance;
use Illuminate\Support\Arr;

class FilterLeaveBalance
{
    protected $query;

    public function __construct(LeaveBalance $leaveBalance)
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

        if ($name = Arr::pull($params, 'name')) {
            $this->query->where('name', $name);
        }

        return $this->query;
    }
}
