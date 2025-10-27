<?php

namespace App\Actions\Permission;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class FilterPermission
{
    protected $query;

    public function __construct(Permission $permission)
    {
        $this->query = $permission->query();
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
