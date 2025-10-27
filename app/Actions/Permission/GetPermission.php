<?php

namespace App\Actions\Permission;

use App\Actions\Permission\FilterPermission;

class GetPermission
{
    protected $filter;

    public function __construct(FilterPermission $filter)
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
