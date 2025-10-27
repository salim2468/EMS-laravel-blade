@if ($errors->any())
<div id="alert-error" class="relative p-4 bg-red-100 text-red-800 border border-red-300 rounded">
    <button onclick="document.getElementById('alert-error').classList.add('hidden')" class="absolute top-0 right-0 px-4 py-3 text-red-800">
        <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 8.586l-2.934 2.934a1 1 0 001.414 1.414L10 10.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z"/>
        </svg>
    </button>

    <ul class="list-disc pl-5 pr-8">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
