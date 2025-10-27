@extends('layouts.admin.app')

@section('title', 'Users')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-100 p-6 shadow rounded">
  <h2 class="text-xl font-bold mb-4">Create New User</h2>
  @if (session('success'))
  <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
  </div>
  @endif
  @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Name & Email --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Name</label>
        <input type="text" name="name" class="w-full border rounded p-2" required>
      </div>
      <div>
        <label class="block">Email</label>
        <input type="email" name="email" class="w-full border rounded p-2" required>
      </div>
    </div>

    {{-- Password --}}
    <div class="mb-4">
      <label class="block">Password</label>
      <input type="password" name="password" class="w-full border rounded p-2" required>
    </div>

    {{-- Province & District --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Province</label>
        <input type="text" name="province" class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block">District</label>
        <input type="text" name="district" class="w-full border rounded p-2">
      </div>
    </div>

    {{-- Address & Phone --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Address</label>
        <input type="text" name="address" class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block">Phone</label>
        <input type="text" name="phone" class="w-full border rounded p-2">
      </div>
    </div>

    {{-- Date of Birth & Gender --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Date of Birth</label>
        <input type="date" name="date_of_birth" class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block">Gender</label>
        <select name="gender" class="w-full border rounded p-2">
          <option value="">-- Select --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
    </div>

    {{-- Joined Date & Job Title --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Joined Date</label>
        <input type="date" name="joined_date" class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block">Job Title</label>
        <input type="text" name="job_title" class="w-full border rounded p-2">
      </div>
    </div>

    {{-- Employment Type & Status --}}
    <div class="grid md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block">Employment Type</label>
        <select name="employment_type" class="w-full border rounded p-2">
          <option value="full-time">Full-time</option>
          <option value="part-time">Part-time</option>
          <option value="contract">Contract</option>
        </select>
      </div>
      <div>
        <label class="block">Status</label>
        <select name="status" class="w-full border rounded p-2">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
    </div>

    {{-- Profile Image --}}
    <div class="mb-4">
      <label class="block">Profile Image</label>
      <input type="file" name="profile_img" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="btn btn-primary">
      Create
    </button>
  </form>
</div>
@endsection