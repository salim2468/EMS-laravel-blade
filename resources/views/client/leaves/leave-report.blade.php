@extends($layout)

@section('title', 'Leave')

@section('content')

<div class="container mx-auto p-4">
    @include('components.header', ['header' => 'My Leave Report'])

    <!-- Search form -->
    <div class="flex flex-col sm:flex-row justify-end mb-4 bg-white p-2">
        <form action="{{ route('user.leaves.leave-report') }}" method="GET"
            class="flex flex-col sm:flex-row items-end gap-2">
            <div class="flex flex-col w-full sm:w-fit">
                <label for="fromDate" class="input-label">From:</label>
                <input type="date" name="fromDate" value="{{ $fromDate }}" />
            </div>

            <div class="flex flex-col w-full sm:w-fit">
                <label for="toDate" class="input-label">To:</label>
                <input type="date" name="toDate" value="{{ $toDate }}" />
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <form action="{{ route('user.leaves.leave-report') }}" method="GET" class="flex items-end sm:ms-2">
            <button type="submit" class="btn btn-secondary">Reset</button>
        </form>
    </div>

    <!-- Employee Table -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr class="bg-gray-100">
                    <th>SN</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Days</th>
                    <th>Leave Type</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaveRequests as $index => $leave)
                <tr>
                    <td>{{ $leaveRequests->firstItem() + $index }}</td>
                    <td>{{ $leave->user->name }}</td>
                    <td class="whitespace-nowrap">{{ $leave->start_date}}</td>
                    <td class="whitespace-nowrap">{{ $leave->end_date}}</td>
                    <td>{{ $leave->count }}</td>
                    <td>{{ $leave->leaveType->name }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>
                        <span class="
                        px-2 py-1 rounded-full text-black text-sm
                        @if($leave->status === 'pending') bg-orange-300
                        @elseif($leave->status === 'approved') bg-green-300
                        @elseif($leave->status === 'cancelled') bg-red-300
                        @else bg-gray-400
                        @endif
                        ">
                            {{ $leave->status }}
                        </span>
                    </td>
                    <td>
                        @if ($leave->status === 'pending')                            
                            <div class="flex gap-x-1 justify-center">
                                <form method="POST" action="{{ route('user.leaves.destroy', $leave->id) }}"
                                    onsubmit="return confirm('Are you sure you want to reject this request?')">
                                    @csrf
                                    @method('DELETE')                                
                                    <button type="submit" class="btn btn-red">Cancel</button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="border px-4 py-2 text-center">No Leave Requested for this month.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $leaveRequests->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
  });
</script>
@endsection