<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\LeaveType\CreateLeaveType;
use App\Actions\LeaveType\UpdateLeaveType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = LeaveType::all();

        return view('admin.leave-types.index', compact('leaves'));
    }

    public function store(StoreLeaveTypeRequest $request, CreateLeaveType $createLeaveType)
    {
        $createLeaveType->execute($request->validated());

        return redirect()->back()->with('success', 'Leave Type created successfully.');
    }

    public function update(StoreLeaveTypeRequest $request, LeaveType $leaveType, UpdateLeaveType $updateLeaveType)
    {
       
        $updateLeaveType->execute($leaveType, $request->validated());

        return redirect()->route('admin.leave-types.index')->with('success', 'Leave Type updated.');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        return redirect()->route('admin.leave-types.index')
            ->with('success', 'Leave deleted successfully.');
    }

    public function create() {
        $leaveCounts = [
            [
                'count' => 4,
                'type' => 'Personal',
            ],
            [
                'count' => 4,
                'type' => 'Personal',
            ],
            [
                'count' => 4,
                'type' => 'Personal',
            ]
        ];
        
        return view('client.leaves.index', compact('leaveCounts'));
    }
}
