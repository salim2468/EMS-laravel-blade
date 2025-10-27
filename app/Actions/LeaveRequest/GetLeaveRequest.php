<?php

namespace App\Actions\LeaveRequest;

class GetLeaveRequest
{
    protected $filter;

    public function __construct(FilterLeaveRequest $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param  array  $parms
     * @param  string  $sort
     * @param  string  $order
     */
    public function execute(array $params = [], $sort = "id", $order = "DESC")
    {
        $query = $this->filter->execute($params);
        $query->orderBy($sort, $order);

        return $query;
    }
}
