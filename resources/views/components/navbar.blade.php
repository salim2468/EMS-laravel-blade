<nav class="bg-dark-primary border-b text-white shadow px-6 py-4 flex justify-between items-center">
  <div class="flex items-center gap-x-4 flex-1">
    <i class="fa-solid fa-bars  md:hidden cursor-pointer sidebar-btn"></i>
    <h1 class="text-xl font-semibold text-gray-100">EMS</h1>
  </div>
  <div class="flex items-center gap-x-2 relative">
    <button id="notificationToggle" class="relative">
      <i class="fa-solid fa-bell cursor-pointer"></i>
      <span id="notification-count" class="bg-red-200 text-xs text-black rounded-full absolute -top-2 -right-1 hidden" style="width: 15px; height: 15px;">0</span>
    </button>
    <div id="notificationDropdown" class="hidden absolute right-16 top-12 bg-white text-black shadow-lg rounded w-64 z-50">
      <ul class="py-2" id="message-box">
        <li class="px-4 py-2 hover:bg-gray-100">📩 Hi again</li>
        <li class="px-4 py-2 hover:bg-gray-100">📩 Hi</li>
      </ul>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-secondary">
        Logout
      </button>
    </form>
  </div>
  </nav>
@push('scripts')
<script>
  $(document).ready(function () {
    const notificationCountEl = $('#notification-count');
    let notificationCount = parseInt(notificationCountEl.text(), 10);
    // Toggle dropdown on click
    $('#notificationToggle').on('click', function (e) {
      e.stopPropagation();
      $('#notificationDropdown').toggleClass('hidden');
      notificationCount = 0;
      notificationCountEl.text(notificationCount);
      notificationCountEl.addClass('hidden');
    });

    // Close dropdown when clicking outside
    $(document).on('click', function () {
      $('#notificationDropdown').addClass('hidden');
    });

    // Prevent closing when clicking inside the dropdown
    $('#notificationDropdown').on('click', function (e) {
      e.stopPropagation();
    });

    const EchoConstructor = Echo.default;
     window.Pusher = Pusher;
     console.log('Echo global:', Echo);

    window.Echo = new EchoConstructor({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true
    });
    // Get the user ID from Laravel (must be authenticated)
    // const userId = {{ auth()->id() }};
    const userId = 2;
    Echo.private(`user.${userId}`)
        .listen('.private-message', (e) => {
            
            notificationCount++;
            const msg = document.createElement('li');
            msg.textContent = '📩 ' + e.message;
            console.log(e.message);
            
            msg.className = 'px-4 py-2 hover:bg-gray-100'; // same classes as existing items
            document.getElementById('message-box').prepend(msg);
            notificationCountEl.text(notificationCount);
              notificationCountEl.removeClass('hidden');
        });
  });
</script>
@endpush