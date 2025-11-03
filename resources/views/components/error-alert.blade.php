@if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded" id="error-sec">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif