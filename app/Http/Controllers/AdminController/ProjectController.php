<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\Project\CreateProject;
use App\Actions\Project\GetProject;
use App\Actions\Project\UpdateProject;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(GetProject $getProject): View
    {
        $keyword = request('keyword', null);
        $managers = User::role('manager')->get();
        $projectStatus = Project::STATUS;
        $projectTypes = Project::TYPE;
        
        $projects = $getProject->execute()->with(['users' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        return view('admin.projects.index', compact('projects', 'keyword', 'managers', 'projectStatus', 'projectTypes'));
    }

    public function store(StoreProjectRequest $storeProjectRequest, CreateProject $createProject): RedirectResponse
    {
        $createProject->execute($storeProjectRequest->validated());

        return redirect()->route('admin.projects.index')->with(['success'=> 'New project created.']);
    }

    public function update(Project $project, StoreProjectRequest $storeProjectRequest, UpdateProject $updateProject): RedirectResponse
    {
        $updateProject->execute($project, $storeProjectRequest->validated());

        return redirect()->route('admin.projects.index')->with(['success'=> 'Project updated.']);
    }
}
