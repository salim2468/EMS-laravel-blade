<?php

namespace App\Actions\Project;

use App\Models\Project;

class CreateProject
{
    /**
     * @param  array  $inputs
     */
    public function execute(array $inputs)
    {
        $project = Project::create($inputs);

        return $project;
    }
}
