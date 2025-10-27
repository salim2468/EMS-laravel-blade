@extends('layouts.admin.app')

@section('title', 'Roles')

@section('content')
  <div class="mx-auto mt-6">
    @include('components.header', ['header' => 'Roles'])

    {{-- Success message --}}
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    {{-- New Role Form --}}
    <form action="{{ route('roles.store') }}" method="POST" class="mb-6 flex items-center gap-x-2">
      @csrf
      <input
        type="text"
        name="name"
        placeholder="New role name"
        value="{{ old('name') }}"
        class="flex-grow border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <button
        type="submit"
        class="btn btn-primary"
      >
        Add Role
      </button>
    </form>
    @error('name')
      <p class="text-red-600 mb-4">{{ $message }}</p>
    @enderror

    {{-- Roles Table --}}
    <div class="table-wrapper">
      <table>
        <thead class="bg-gray-100 text-gray-600">
          <tr>
            <th>#</th>
            <th>Role Name</th>
            <th>Permissions</th>
            <th>Assign Permission</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr class="border-b align-top">
              <td>{{ $loop->iteration }}</td>
              <td class="font-semibold">{{ ucfirst($role->name) }}</td>
              <td class="text-left">
                @if ($role->permissions->isEmpty())
                  <span class="text-gray-400 italic">No permissions</span>
                @else
                  <ul class="list-disc pl-5">
                    @foreach ($role->permissions as $permission)
                      <li>{{ $permission->name }}</li>
                    @endforeach
                  </ul>
                @endif
              </td>
              <td>
                <form action="{{ route('roles.assignPermission', $role->id) }}" method="POST" class="flex items-center justify-center space-x-2">
                  @csrf
                  <select name="permission" class="border rounded px-3 py-1">
                    @foreach ($allPermissions as $permission)
                      <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-primary">
                    Add
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