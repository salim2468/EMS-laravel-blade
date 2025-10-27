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
                <td>{{ $employee->designation }}</td>
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