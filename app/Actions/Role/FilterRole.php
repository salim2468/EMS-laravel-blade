<?php

namespace App\Actions\Role;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class FilterRole
{
    protected $query;

    public function __construct(Role $role)
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
