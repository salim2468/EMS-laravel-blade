<?php

namespace App\Actions\Project;

use App\Models\Project;

class UpdateProject
{
    /**
     * @param  Project  $project
     * @param  array  $inputs
     */
    public function execute(Project $project, array $inputs)
    {
        $project->update($inputs);
    }
}
