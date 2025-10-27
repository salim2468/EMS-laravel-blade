<?php

namespace App\Actions\FilterWorkFromHome;

use App\Models\WorkFromHomeRequest;

class UpdateWorkFromHome
{
    /**
     * @param  WorkFromHomeRequest  $workFromHomeRequest
     * @param  array  $inputs
     */
    public function execute(WorkFromHomeRequest $workFromHomeRequest, array $inputs)
    {
        $workFromHomeRequest->update($inputs);
    }
}
