
<div class="overflow-x-auto whitespace-nowrap p-4 bg-primary rounded">
    <div class="inline-flex gap-4">
        {{-- Example item --}}
        @foreach ($leaveCounts as $leave)
            <div class="flex items-center bg-white shadow p-3 rounded-lg w-44">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-primary text-white text-lg font-bold">
                    {{ $leave['count'] }}
                </div>
                <div class="flex-1 text-sm font-medium text-gray-700 text-center">
                    <span>{{ $leave['type'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>