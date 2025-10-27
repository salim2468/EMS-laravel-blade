@extends('layouts.admin.app')

@section('title', 'Users')

@section('content')

<div class="mx-auto mt-6">
  @include('components.header', ['header' => 'Employees'])

  @if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div class="flex flex-col justify-between mb-4 md:flex-row gap-2">
    <a class="btn btn-primary w-fit" href="{{ route('admin.employees.create') }}">Add</a>
    <form action="{{ route('admin.employees.index') }}" method="GET" class="flex items-center gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ $search }}" 
            placeholder="Search employees..." 
            class="border border-gray-300 rounded px-3 py-1"
        />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Current Roles</th>
          <th>Assign Role</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
          <tr class="border-b">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>
              @foreach ($employee->getRoleNames() as $role)
                <span class="bg-gray-700 text-xs text-white px-2 py-1 rounded shadow">{{ $role }}</span>
              @endforeach
            </td>
            <td>
              <form action="{{ route('admin.employees.assignRole', $employee->id) }}" method="POST" class="flex items-center justify-center space-x-2">
                @csrf
                <select name="role" class="border rounded px-3 py-1">
                  @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                  @endforeach
                </select>
                <button type="submit" class="btn btn-primary">
                  Assign
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection