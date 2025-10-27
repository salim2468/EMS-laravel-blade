@if (session('success')) 
  <div id="alert-success" class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded absolute top-20 right-6 flex items-center gap-x-2" role="alert">
      <span class="">{{ session('success') }}</span>
      <button onclick="document.getElementById('alert-success').classList.add('hidden')" class="text-green-800 border border-green-800">
        <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <title>Close</title>
          <path d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 8.586l-2.934 2.934a1 1 0 001.414 1.414L10 10.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z"/>
        </svg>
      </button>
  </div>
@endif