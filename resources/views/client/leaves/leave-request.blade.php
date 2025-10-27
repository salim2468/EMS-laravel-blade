@extends($layout)

@section('title', 'Leave')

@section('content')
<div class="container mx-auto p-4">
  @include('components.header', ['header' => 'Leave Request'])

  <!-- Search form -->
  <div class="flex justify-end mb-4">
      <form action="{{ route('user.employees.index') }}" method="GET" class="flex items-center gap-2">
          <input 
              type="text" 
              name="search" 
              value="{{ $search }}" 
              placeholder="Search employees..." 
              class="border border-gray-300 rounded px-3 py-1"
          />
          <button type="submit" class="btn btn-primary">Search</button>
      </form>
  </div>

  <!-- Employee Table -->
  <div class="table-wrapper">
    <table>
      <thead>
        <tr class="bg-gray-100">
            <th>SN</th>
            <th>Name</th>
            <th colspan="2">Date</th>
            <th>Days</th>
            <th>Leave Type</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($usersOnLeave as $index => $leave)
        <tr>
            <td>{{ $usersOnLeave->firstItem() + $index }}</td>
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
            @if($leave->status === 'approved')
            <td>
              <div class="flex gap-x-1 justify-center items-center">
                <form method="POST" action="{{ route('leaves.force-cancel', $leave->id) }}" onsubmit="return confirm('Are you sure you want to force cancel this already accepted leave ?')">
                  @csrf
                  <button type="submit" class="btn btn-red">Force Cancel</button>
                </form>
              </div>
            </td>
            @elseif ($leave->status === 'pending')
            <td>
              <div class="flex gap-x-1 justify-center">
                <form method="POST" action="{{ route('leaves.approve', $leave->id) }}" onsubmit="return confirm('Are you sure you want to accept this request?')">
                  @csrf
                  <button type="submit" class="btn btn-primary">Accept</button>
                </form>

                <form method="POST" action="{{ route('leaves.reject', $leave->id) }}" onsubmit="return confirm('Are you sure you want to reject this request?')">
                  @csrf
                  <button type="submit" class="btn btn-red">Reject</button>
                </form>
              </div>
            </td>
            @else
            <td></td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="8" class="border px-4 py-2 text-center">No One Has Requested Leave.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination links -->
  <div class="mt-4">
      {{ $usersOnLeave->links() }}
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
  });
</script>
@endsection