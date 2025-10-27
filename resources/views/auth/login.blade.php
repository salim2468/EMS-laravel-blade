<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
    
    {{-- Display validation errors --}}
    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form method="POST" action="{{ route('user.login') }}" class="space-y-4">
      @csrf 

      {{-- Email Input --}}
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="mt-1 block w-full px-4 py-2 border border-gray-300 shadow-sm
                 focus:outline-none focus:ring-1 focus:ring-blue-800 focus:border-blue-800"
        />
      </div>

      {{-- Password Input --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 shadow-sm
                 focus:outline-none focus:ring-1 focus:ring-blue-800 focus:border-blue-800"
        />
      </div>

      {{-- Submit Button --}}
      <button
        type="submit"
        class="w-full btn btn-primary"
      >
        Login
      </button>
    </form>
  </div>

</body>
</html>