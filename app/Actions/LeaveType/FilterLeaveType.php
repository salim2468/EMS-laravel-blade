<?php

namespace App\Actions\LeaveType;

use App\Models\LeaveType;
use Illuminate\Support\Arr;

class FilterLeaveType
{
    protected $query;

    public function __construct(LeaveType $role)
    {
        $this->query = $role->query();
    }
    /**
     * @param  array  $params
     */
    public function execute(array $params = [])
    {
        if ($id = Arr::pull($params, 'id')) {
            $this->query->where('id', $id);
        }

        if ($name = Arr::pull($params, 'name')) {
            $this->query->where('name', $name);
        }

        return $this->query;
    }
}
