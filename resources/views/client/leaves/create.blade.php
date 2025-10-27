@extends('layouts.clients.app')

@section('title', 'Leave')

@section('content')
@include('components.header', ['header' => 'Apply Leave'])
@include('client.leaves.leave_count')

<form action="{{ route('user.leaves.apply') }}" method="POST" class="max-w-lg mx-auto my-4 bg-white p-6 rounded shadow space-y-4">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <!-- Leave Type -->
    <div>
      <label for="leave_type_id" class="block text-sm font-medium text-gray-700">Leave Type</label>
      <select id="leave_type_id" name="leave_type_id" class="mt-1 block w-full border border-gray-300 rounded p-2">
        @foreach ($getLeaveType as $leaveType)
          <option value="{{ $leaveType->id }}" {{ old('leave_type_id') === $leaveType->id ? 'selected' : '' }}>{{$leaveType->name}}</option>
        @endforeach
      </select>
    </div>
    
    <!-- Day Type -->
    <div>
      <span class="block text-sm font-medium text-gray-700 mb-1">Leave Duration</span>
      <div class="flex gap-4">
        <label class="inline-flex items-center">
          <input type="radio" name="day_type" value="half" class="form-radio text-blue-600"
            {{ old('day_type') === 'half' ? 'checked' : '' }}>
          <span class="ml-2">Half Day</span>
        </label>

        <label class="inline-flex items-center">
          <input type="radio" name="day_type" value="single" class="form-radio text-blue-600"
            {{ old('day_type', 'single') === 'single' ? 'checked' : '' }}>
          <span class="ml-2">Single Day</span>
        </label>

        <label class="inline-flex items-center">
          <input type="radio" name="day_type" value="multiple" class="form-radio text-blue-600"
            {{ old('day_type') === 'multiple' ? 'checked' : '' }}>
          <span class="ml-2">Multiple Days</span>
        </label>
      </div>
    </div>

    <div id="shift-dropdown" class="{{ old('day_type') === 'half' ? '' : 'hidden' }}">
      <label for="shift" class="block text-sm font-medium text-gray-700"> Shift</label>
      
      <select id="shift" name="shift" class="mt-1 block w-full border border-gray-300 rounded p-2">
        <option value="First half" {{ old('shift') === 'First half' ? 'selected' : '' }}>First Half</option>
        <option value="Second half" {{ old('shift') === 'Second half' ? 'selected' : '' }}>Second Half</option>
      </select>
    </div>

    <div class="flex flex-col md:flex-row gap-4">
      <div id="start-day-calender" class="w-full md:w-1/2">
        <label for="start_date" id="start-date-label" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" id="start_date" name="start_date" class="mt-1 block w-full border border-gray-300 rounded p-2">
      </div>

      <div id="multiple-day-calender" class="w-full md:w-1/2 hidden">
        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
        <input type="date" id="end_date" name="end_date" class="mt-1 block w-full border border-gray-300 rounded p-2">
      </div>
    </div>

    <div>
      <label for="reason" class="block text-sm font-medium text-gray-700">Description</label>
      <textarea id="reason" name="reason" rows="3" class="mt-1 block w-full border border-gray-300 rounded p-2"></textarea>
    </div>

    <div class="flex justify-between">
      <button type="submit" class="btn btn-primary">Apply</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>

@include('components.error-alert')

@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('input[name="day_type"]').on('change', function() {
      const selectedValue = $('input[name="day_type"]:checked').val();
      const signleDayCalender = $('#single-day-calender');
      const multipleDayCalender = $('#multiple-day-calender');
      const shiftDropdown = $('#shift-dropdown');
      const startDateLabel = $('#start-date-label');
      switch(selectedValue) {
        case 'single':
          multipleDayCalender.addClass('hidden');
          shiftDropdown.addClass('hidden');
          startDateLabel.text('Date');
          break;
        case 'multiple':
          multipleDayCalender.removeClass('hidden');
          shiftDropdown.addClass('hidden');
          startDateLabel.text('Start Date');
          break;
        case 'half':
          multipleDayCalender.addClass('hidden');
          shiftDropdown.removeClass('hidden')
          startDateLabel.text('Date');
          break; 
      }
    });
  });
</script>
@endpush