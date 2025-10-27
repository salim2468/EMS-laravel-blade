<?php

namespace App\Actions\WorkFromhHome;

use App\Models\WorkFromHomeRequest;
use Illuminate\Support\Arr;

class FilterWorkFromHome
{
    protected $query;

    public function __construct(WorkFromHomeRequest $workFromHomeRequest)
    {
        $this->query = $workFromHomeRequest->query();
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
