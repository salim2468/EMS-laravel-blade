<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Dashboard')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script>
</head>

<body class="bg-light-primary h-screen overflow-hidden">
  {{-- Top Navbar --}}
  @include('components.navbar')

  {{-- Sidebar + Main Content --}}
  <div class="flex h-[calc(100vh-64px)]">
    @include('components.clients.sidebar')

    <main class="flex-1 sm:p-6 overflow-y-auto">
      {{-- sucess alert --}}
      @include('components.sucess-alert')

      @yield('content')
    </main>
  </div>
  <script>
    $(document).ready(function () {
      $('.sidebar-btn').on('click', function () {
        console.log('menu icon');
        
        $('#sidebar').toggleClass('-translate-x-full translate-x-0');
      })
    })
  </script>
  @stack('scripts')
</body>

</html>