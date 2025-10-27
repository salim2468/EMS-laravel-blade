<?php

namespace App\Http\Controllers\ClientController;

use App\Actions\Leave\ApplyLeave;
use App\Actions\Leave\ApproveLeave;
use App\Actions\Leave\RejectLeave;
use App\Actions\LeaveBalance\GetLeaveBalance;
use App\Actions\LeaveRequest\GetLeaveRequest;
use App\Actions\LeaveType\GetLeaveType;
use App\Events\NotificationBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplyLeaveRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaveController extends Controller
{
    public function employeeOnLeave(GetLeaveRequest $getLeaveRequest): View
    {
        $params['fromDate'] = today();
        $params['toDate'] = today();
        $data = $getLeaveRequest->execute($params)->with(['user', 'leaveType'])->paginate(10);

        return view('client.leaves.index', compact('data'));
    }

    public function create(GetLeaveType $getLeaveType, GetLeaveBalance $leaveBalance): View
    {
        $params['user_id'] = auth()->user()->id;
        $leaveCounts = $leaveBalance->execute($params)->with('leaveType')->get();
        $getLeaveType = $getLeaveType->execute()->get();

        return view('client.leaves.create', compact('leaveCounts', 'getLeaveType'));
    }

    public function leaveRequest(Request $request, GetLeaveRequest $leaveRequest): View
    {
        $search = $request->input('search');
        $params['approved_by_id'] = auth()->user()->id;
        $usersOnLeave = $leaveRequest->execute($params)->with('user:id,name', 'leaveType:id,name')->paginate(5);

        $layout = auth()->user()->hasRole('admin') ? 'layouts.admin.app' : 'layouts.clients.app';

        return view('client.leaves.leave-request', compact('usersOnLeave', 'search', 'layout'));
    }

    public function applyLeave(StoreApplyLeaveRequest $request, ApplyLeave $applyLeave): RedirectResponse
    {
        try {
            $applyLeave->execute($request->validated());

            return redirect()->route('user.leaves.create')->with('success', 'Leave applied successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->withErrors(['order_error' => $e->getMessage()]);
        }
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

    public function forceCancelLeave(LeaveRequest $leaveRequest): RedirectResponse
    {
        
        return redirect()->route('user.leaves.request')->with('success', 'Leave has been forced cancelled!');
    }

    // user leave report
    public function leaveReport(GetLeaveRequest $getLeaveRequest): View
    {
        $keyword = request('keyword');
        $fromDate  = request('fromDate');
        $toDate    = request('toDate');

        $params['user_id'] = auth()->user()->id;
        $params['fromDate'] = $fromDate;
        $params['toDate'] = $toDate;
        $leaveRequests = $getLeaveRequest->execute($params)->paginate(10);
        $layout = auth()->user()->hasRole('admin') ? 'layouts.admin.app' : 'layouts.clients.app';

        return view('client.leaves.leave-report', compact('leaveRequests', 'keyword', 'layout', 'fromDate', 'toDate'));
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('user.leaves.leave-report')->with('success', 'You have Cancelled Leave.');
    }
}
