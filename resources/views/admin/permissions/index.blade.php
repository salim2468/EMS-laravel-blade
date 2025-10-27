@extends('layouts.admin.app')

@section('title', 'Permissions')

@section('content')
<div class="mx-auto mt-6">
    @include('components.header', ['header' => 'Permissions'])

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Permission Form --}}
    <form method="POST" action="{{ route('permissions.store') }}" class="mb-6 flex items-center justify-center gap-x-2">
        @csrf
        <input
            type="text"
            name="name"
            placeholder="New permission name"
            class="flex-grow border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <button
            type="submit"
            class="btn btn-primary"
        >
            Add
        </button>
    </form>

    @error('name')
        <p class="text-red-600 mb-4">{{ $message }}</p>
    @enderror

    {{-- Permission Table --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Permission Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr class="border-b">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <button 
                                class="edit-btn" 
                                data-id="{{ $permission->id }}" 
                                data-name="{{ $permission->name }}"
                                >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="py-3 px-4 text-center text-gray-500">No permissions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Side Panel (Hidden by Default) --}}
    <div 
        id="editPanel"
        class="fixed top-0 right-0 w-full max-w-sm h-full bg-light-primary shadow-xl p-6 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Edit Permission</h2>
            <button onclick="closeEditPanel()" class="text-gray-600 hover:text-black text-2xl">&times;</button>
        </div>
            <form id="editForm" method="POST" action="{{ route('admin.permissions.update', ['permission' => 'dummy-id']) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="permissionId">
                <label class="block mb-2">Permission Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="permissionName" 
                    class="w-full border rounded p-2 mb-4" 
                />
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-dark-secondary" onclick="closeEditPanel()">Cancel</button>
            </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const panel = document.getElementById('editPanel');
    const form = document.getElementById('editForm');
    const inputId = document.getElementById('permissionId');
    const inputName = document.getElementById('permissionName');
  
    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
  
        inputId.value = id;
        inputName.value = name;
        const routeTemplate = form.getAttribute('action'); 
        const updatedRoute = routeTemplate.replace('dummy-id', id);
        form.action = updatedRoute;
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
      });
    });
  
    function closeEditPanel() {
      panel.classList.remove('translate-x-0');
      panel.classList.add('translate-x-full');
    }
  </script>
@endpush

