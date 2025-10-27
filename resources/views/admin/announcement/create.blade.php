@extends('layouts.admin.app')

@section('title', 'Announcement')

@section('content')
<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Announcement</h1>
  <div class="flex flex-col sm:flex-row gap-4">
    <form action="{{ route('admin.announcement.store') }}" method="POST" class="flex-1 h-fit my-4 bg-white p-6 rounded shadow space-y-4">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div>
        <label for="message" class="block text-sm font-medium text-gray-700">Announcement Description</label>
        <textarea id="message" name="message" rows="3" class="mt-1 block w-full border border-gray-300 rounded p-2"></textarea>
      </div>
      <div class="flex justify-between">
        <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
        <button type="reset" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Reset</button>
      </div>
    </form>
    <div class="messages bg-gray-400 p-2 flex-1 my-4">
      @include('components.announcement-message', ['message' => 'Hi'])
      
    </div>
  </div>
  @include('components.error-alert')
  @endsection
  @push('scripts')
  <script>
    $(document).ready(function() {
      
    });
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key') }}', {cluster: 'ap2'});
    const channel = pusher.subscribe('public');

    $("form").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: "/broadcast",
        method: 'POST',
        headers: {
          'X-Socket-Id': pusher.connection.socket_id
        },
        data: {
          _token: '{{ csrf_token() }}',
          message: $('form #message').val()
        }
      }).done(function(res) {
        $(".messages > .message").last().after(res);
        $('form #message').val('');
      })
    });
  </script>
  @endpush