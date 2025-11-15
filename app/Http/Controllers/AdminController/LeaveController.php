<?php

namespace App\Http\Controllers\AdminController;

use App\Actions\Leave\ApproveLeave;
use App\Actions\Leave\ForceRejectLeave as LeaveForceRejectLeave;
use App\Actions\Leave\RejectLeave;
use App\Actions\LeaveType\CreateLeaveType;
use App\Actions\LeaveType\UpdateLeaveType;
use App\Events\NotificationBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function create()
    {
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

    public function approveLeave(LeaveRequest $leaveRequest, ApproveLeave $approveLeave): RedirectResponse
    {
        $approveLeave->execute($leaveRequest);
        event(new NotificationBroadcast('Your Leave has been Approved', 2));

        return redirect()->route('user.leaves.request')->with('success', 'Leave successfully approved!');
    }

    public function rejectLeave(LeaveRequest $leaveRequest, RejectLeave $rejectLeave): RedirectResponse
    {
        $rejectLeave->execute($leaveRequest);
        event(new NotificationBroadcast('Your Leave has been Rejected', 2));

        return redirect()->route('user.leaves.request')->with('success', 'Leave sucessfully rejected!');
    }

    public function forceRejectLeave(LeaveRequest $leaveRequest, LeaveForceRejectLeave $forceRejectLeave): RedirectResponse
    {
        $forceRejectLeave->execute($leaveRequest);

        return redirect()->route('user.leaves.request')->with('success', 'Leave has been forced cancelled!');
    }
}
