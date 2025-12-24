<?php

namespace App\Actions\Project;

use App\Models\Project;
use Illuminate\Support\Arr;

class FilterProject
{
    protected $query;

    public function __construct(Project $project)
    {
        $this->query = $project->query();
    }
    /**
     * @param  array  $params
     */
    public function execute(array $params = [])
    {
        if ($id = Arr::pull($params, 'id')) {
            $this->query->where('id', $id);
        }

        if ($title = Arr::pull($params, 'title')) {
            $this->query->where('title', $title);
        }

        return $this->query;
    }
}
