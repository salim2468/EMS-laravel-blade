@extends('layouts.clients.app')
@section('title', 'Profile')
@section('content')
<div class="min-h-screen flex flex-col md:flex-row">
    <aside class="bg-dark-primary text-white w-full md:w-64 p-4 flex md:flex-col md:h-screen space-x-4 md:space-x-0 md:space-y-4 overflow-x-auto md:overflow-visible">
      <a href="#" class="sidebar-link block px-2 py-1 hover:bg-gray-700 rounded bg-gray-700" data-target="personal">Personal Details</a>
      <a href="#" class="sidebar-link block px-2 py-1 hover:bg-gray-700 rounded" data-target="address">Address Details</a>
      <a href="#" class="sidebar-link block px-2 py-1 hover:bg-gray-700 rounded" data-target="job">Job Details</a>
      <a href="#" class="sidebar-link block px-2 py-1 hover:bg-gray-700 rounded" data-target="bank">Bank Details</a>
    </aside>
    <div class="flex flex-col flex-1 min-h-screen">
        @include('components.sucess-alert')
        @include('components.error-alert')
    <!-- Personal Section -->
    <section id="section-personal" class="flex-1 p-6 bg-gray-100 section-content">
        <h1 class="text-xl font-semibold mb-4">Personal Detail</h1>
        <div class="flex items-center flex-col mb-6">
          <img src="" alt="Profile Image" class="w-32 h-32 rounded-full bg-gray-200">
          <span>{{ $user->name }}</span>
        </div>
        <div class="flex justify-end my-2">
            <button class="btn btn-primary edit-btn">Edit</button>
        </div>
        <form method="POST" action="{{ route('user.profile.updatePersonal') }}">
            @csrf
            <div id="profile-form" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" disabled value="{{ $user->email }}" class="w-full border profile-input">
                </div>
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                <input type="text" name="job_title" disabled value="{{ $user->job_title }}" class="w-full border profile-input">
                </div>
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Joined Date</label>
                <input type="date" name="joined_date" disabled value="{{ $user->joined_date }}" class="w-full border profile-input">
                </div>
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                <input type="text" name="employment_type" disabled value="{{ $user->employment_type }}" class="w-full border profile-input">
                </div>            
                <div class="md:col-span-2 flex justify-end gap-4 mt-4 hidden edit-actions">
                    <button type="submit" class="btn btn-primary" id="update-btn">Update</button>
                    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                </div>
            </div>
        </form>
    </section>
    <!-- Address Section -->
    <section id="section-address" class="flex-1 p-6 bg-gray-100 section-content hidden">
        <h2 class="text-xl font-semibold mb-4">Address Details</h2>
        <div class="flex justify-end my-2">
            <button class="btn btn-primary edit-btn">Edit</button>
        </div>
        <form method="POST" action="{{ route('user.profile.updateAddress') }}">
            @csrf
            <div id="profile-form" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                    <input type="text" name="province" disabled value="{{ $user->province }}" class="w-full border profile-input">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                    <input type="text" name="district" disabled value="{{ $user->district }}" class="w-full border profile-input">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" disabled value="{{ $user->address }}" class="w-full border profile-input">
                </div>
                <div class="md:col-span-2 flex justify-end gap-4 mt-4 hidden edit-actions">
                    <button type="submit" class="btn btn-primary" id="update-btn">Update</button>
                    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                </div>
            </div>
        </form>
    </section>
    <section id="section-job" class="flex-1 p-6 bg-gray-100 section-content hidden">
        <h2 class="text-xl font-semibold mb-4">Job Details</h2>
        <p>Job Details form goes here...</p>
    </section>
    <section id="section-bank" class="flex-1 p-6 bg-gray-100 section-content hidden">
        <h2 class="text-xl font-semibold mb-4">Bank Details</h2>
        <p>Bank form goes here...</p>
    </section>
</div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function () {
                $('.profile-input').prop('disabled', false);
                $('.edit-actions').removeClass('hidden');
                $('.edit-btn').prop('disabled', true);
            });

            $('.cancel-btn').on('click', function () {
                $('.profile-input').prop('disabled', true);
                $('.edit-actions').addClass('hidden');
                $('.edit-btn').prop('disabled', false);
            });

            $('.sidebar-link').on('click', function (e) {
                e.preventDefault();
                const target = $(this).data('target');
                $('.section-content').addClass('hidden');
                $('#section-' + target).removeClass('hidden');
                $('.sidebar-link').removeClass('bg-gray-700');
                $(this).addClass('bg-gray-700');
            });
        });
    </script>
@endpush
