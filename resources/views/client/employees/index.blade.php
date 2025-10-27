@extends('layouts.clients.app')

@section('title', 'Leave')

@section('content')

<div class="container mx-auto p-4">
    @include('components.header', ['header' => 'Employee'])

    <!-- Search form -->
    <div class="flex justify-end mb-4">
        <form action="{{ route('user.employees.index') }}" method="GET" class="flex items-center gap-2">
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

    <!-- Employee Table -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr class="bg-gray-100">
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Number</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $index => $employee)
                <tr>
                    <td>{{ $employees->firstItem() + $index }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->job_title }}</td>
                    <td>{{ $employee->phone }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No employees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $employees->links() }}
    </div>
</div>
@endsection
