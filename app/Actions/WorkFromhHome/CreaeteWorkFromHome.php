<?php

namespace App\Actions\WorkFromhHome;

use App\Models\WorkFromHomeRequest;

class CreaeteWorkFromHome
{
    /**
     * @param  array  $inputs
     */
    public function execute(array $inputs)
    {
        $leaveType = WorkFromHomeRequest::create($inputs);

        return $leaveType;
    }
}
