@extends('layouts.clients.app')

@section('title', 'Leave')

@section('content')

<div class="container mx-auto p-4">
  @include('components.header', ['header' => 'Employee On Leave'])

  <!-- Employee Table -->
  <div class="table-wrapper">
    <table>
      <thead>
        <tr class="bg-gray-100">
          <th>SN</th>
          <th>Name</th>
          <th>From</th>
          <th>To</th>
          <th>Leave Days</th>
          <th>Leave Type</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $index => $item)
        <tr>
          <td>{{ $data->firstItem() + $index }}</td>
          <td>{{ $item->user->name }}</td>
          <td>{{ $item->start_date }}</td>
          <td>{{ $item->end_date }}</td>
          <td>{{ $item->count }}</td>
          <td>{{ $item->leaveType->name }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="border px-4 py-2 text-center">No employees found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination links -->
  <div class="mt-4">
    {{ $data->links() }}
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
  });
</script>
@endpush