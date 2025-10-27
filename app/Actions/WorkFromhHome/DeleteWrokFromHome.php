<?php

namespace App\Actions\WorkFromhHome;

use App\Models\WorkFromHomeRequest;

class DeleteWrokFromHome
{
    /**
     * @param  WorkFromHomeRequest  $workFromHomeRequest
     */
    public function execute(WorkFromHomeRequest $workFromHomeRequest)
    {
        $workFromHomeRequest->delete();
    }
}
