<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\User\GetUser;
use App\Actions\WorkFromhHome\CreaeteWorkFromHome;
use App\Actions\WorkFromhHome\DeleteWrokFromHome;
use App\Actions\WorkFromhHome\GetWorkFromHome;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkFromHomeRequest;
use App\Models\User;
use App\Models\WorkFromHomeRequest;

class WfhController extends Controller
{
    public function index(GetWorkFromHome $getWorkFromHome)
    {
        // TODO
        $search = request('search');
        $employees = User::paginate(5);
        // $employees = $getWorkFromHome->execute()->paginate(10);

        return view('admin.wfh.index', compact('employees', 'search'));
    }

    public function create(GetUser $getUser)
    {
        $employees = $getUser->execute();
        return view('admin.wfh.create', compact($employees));
    }

    public function store(StoreWorkFromHomeRequest $storeWorkFromHomeRequest, CreaeteWorkFromHome $creaeteWorkFromHome)
    {
        $creaeteWorkFromHome->execute($storeWorkFromHomeRequest->validated());

        return redirect()->route('admin.wfh..index')->with('success', 'Permission created successfully!');
    }

    public function destroy(WorkFromHomeRequest $workFromHomeRequest, DeleteWrokFromHome $deleteWrokFromHome)
    {
        $deleteWrokFromHome->execute($workFromHomeRequest);

        return redirect()->route('admin.wfh..index')->with('success', 'Work from home cancelled');
    }
}
