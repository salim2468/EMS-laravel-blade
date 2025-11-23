@extends('layouts.clients.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col">
    <div class="bg-primary px-4 py-5 flex justify-between items-center text-white">
        <div class="flex items-center gap-x-2">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF02Jj8T2t7PdkytAw42HDuuSz7yXguKn8Lg&s"
                alt="" class="h-14 w-14 rounded-full">
            <div class="flex flex-col">
                <p class="text-sm">{{ $user->name }}</p>
                <p class="text-xs">{{ $user->job_title }}</p>
            </div>
        </div>
        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Profile</a>
    </div>

    <div class="flex flex-col md:flex-row gap-4 my-4 h-[600px] md:h-[300px]">
        <div class="bg-white p-5 flex-1 overflow-hidden h-[300px]">
            <h3 class="mb-2">Leave Days</h3>
            @foreach ($leaveCounts as $leave)
            <div class="flex justify-between mb-1">
                <span class="text-xs">{{ $leave['leaveType']['name'] ?? 'N/A' }}</span>
                <span class="text-xs">{{ $leave['used_days'] ?? 0 }} of {{ $leave['total_days'] + $leave['used_days'] ?? 0 }} day(s)</span>
            </div>
            <div class="h-4 bg-gray-300 mb-2">
                @php
                $total = $leave['total_days'] ?? 1;
                $used = $leave['used_days'] ?? 0;
                $percentage = ($used / $total) * 100;
                @endphp
                <div class="h-4 bg-dark-primary animate-progress" style="--final-width: {{ $percentage }}%; width: 0">
                </div>
            </div>
            @endforeach
        </div>
        <div class="bg-white p-5 flex-1 flex flex-col h-[300px]">
            <h3 class="mb-2">Announcement</h3>
            <div class="mb-1 overflow-y-auto flex-1 messages">
                <p class="text-xs my-2 bg-light-primary rounded p-3 message">Annual Leave Should be taken</p>
                <p class="text-xs my-2 bg-light-primary rounded p-3 message">Annual Leave Should be taken</p>
                <p class="text-xs my-2 bg-light-primary rounded p-3 message">Annual Leave Should be taken</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key') }}', {cluster: 'ap2'});
    const channel = pusher.subscribe('public');

    channel.bind('chat', function(data){
        $.post("/receive", {
        _token: '{{ csrf_token() }}',
        message: data.message,
        }).done(function (res){
            $(".messages").prepend(res);
            $(document).scrollTop($(document).height());
        })
    })
</script>
@endpush