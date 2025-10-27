<?php

namespace App\Http\Controllers\ClientController;

use App\Actions\User\GetUser;
use App\Actions\WorkFromhHome\CreaeteWorkFromHome;
use App\Actions\WorkFromhHome\DeleteWrokFromHome;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkFromHomeRequest;
use App\Models\User;
use App\Models\WorkFromHomeRequest;

class WfhController extends Controller
{
    public function index()
    {
        // TODO
        $search = request('search');
        $employees = User::paginate(5);

        return view('client.wfh.index', compact('employees', 'search'));
    }

    public function create(GetUser $getUser)
    {
        $employees = $getUser->execute();

        return view('client.wfh.create', compact('employees'));
    }

    public function store(StoreWorkFromHomeRequest $storeWorkFromHomeRequest, CreaeteWorkFromHome $creaeteWorkFromHome)
    {
        $creaeteWorkFromHome->execute($storeWorkFromHomeRequest->validated());

        return redirect()->route('user.wfh..index')->with('success', 'Permission created successfully!');
    }

    public function destroy(WorkFromHomeRequest $workFromHomeRequest, DeleteWrokFromHome $deleteWrokFromHome)
    {
        $deleteWrokFromHome->execute($workFromHomeRequest);

        return redirect()->route('user.wfh..index')->with('success', 'Work from home cancelled');
    }
}
