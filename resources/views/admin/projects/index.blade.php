@extends('layouts.admin.app')

@section('title', 'Projects')

@section('content')
<div class="mx-auto mt-6">
    @include('components.header', ['header' => 'Projects'])

    <div class="flex flex-col justify-between mb-4 md:flex-row gap-2">
        <a class="btn btn-primary w-fit add-btn">Add</a>
        <form action="{{ route('admin.projects.index') }}" method="GET" class="flex items-center gap-2">
            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Search employees..."
                class="border border-gray-300 rounded px-3 py-1" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    {{-- Project Table --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Type</th>
                    <th>Manager</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="border-b">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <span class="
                            px-2 py-1 rounded-full text-black text-sm
                            @if($project->type === 'in_house') bg-blue-400
                            @elseif($project->type === 'client') bg-green-400
                            @else bg-gray-400
                            @endif
                            ">
                            {{ $projectTypes[$project->type] }}
                        </span></td>
                        <td>{{ optional($project->users)->name ?? '-' }}</td>
                        <td>
                            <span class="
                            px-2 py-1 rounded-full text-black text-sm
                            @if($project->status === 'pending') bg-orange-300
                            @elseif($project->status === 'in_progress') bg-green-300
                            @elseif($project->status === 'completed') bg-gray-300
                            @elseif($project->status === 'on_hold') bg-blue-300
                            @elseif($project->status === 'cancelled') bg-red-300
                            @else bg-gray-400
                            @endif
                            ">
                                {{ $projectStatus[$project->status] }}
                            </span>
                        </td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>
                            <button class="edit-btn" data-project="{{ $project }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('admin.permissions.destroy', $project->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')" style="display:inline;">
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
                        <td colspan="2" class="py-3 px-4 text-center text-gray-500">No project found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Side Panel (Hidden by Default) --}}
    <div id="editPanel"
        class="fixed top-0 right-0 w-full max-w-sm h-full bg-light-primary shadow-xl p-6 transform translate-x-full transition-transform duration-300 z-50 overflow-y-scroll">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Project</h2>
            <button onclick="closeEditPanel()" class="text-gray-600 hover:text-black text-2xl">&times;</button>
        </div>
        
        @include('components.error-alert')

        <form id="editForm" data-mode="create" method="POST"
            action="{{ route('admin.projects.store', ['project' => 'dummy-id']) }}">
            @csrf
            <input type="hidden" name="id" id="projectId">
            
            <label class="block mb-2 text-sm">Project Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2 mb-4" value="{{ old('title') }}"/>
            
            <label class="block mb-2 text-sm">Type</label>
            <select name="type" id="type" class="w-full border rounded p-2 mb-4">
                @foreach ($projectTypes as $index => $type)
                <option value="{{ $index }}"  {{ old('type') === $index  ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>

            <label class="block mb-2 text-sm">Manager</label>
            <select name="manager_id" id="mangerId" class="w-full border rounded p-2 mb-4">
                @foreach ($managers as $manager)
                <option value="{{ $manager->id }}" {{ old('manager_id') === $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                @endforeach
            </select>

            <label class="block mb-2 text-sm">Status</label>
            <select name="status" id="status" class="w-full border rounded p-2 mb-4">
                @foreach ($projectStatus as $index => $stauts)
                <option value="{{ $index }}" {{ old('status') === $index ? 'selected' : '' }}>{{ $stauts }}</option>
                @endforeach
            </select>

            <label class="block mb-2 text-sm">Start Date</label>
            <input type="date" name="start_date" id="startDate" class="w-full border rounded p-2 mb-4" value="{{ old('start_date') }}"/>
            <label class="block mb-2 text-sm">End Date</label>
            <input type="date" name="end_date" id="endDate" class="w-full border rounded p-2 mb-4" value="{{ old('end_date') }}"/>

            <button type="submit" id="submitBtn" class="btn btn-primary">Add Project</button>
            <button type="button" class="btn btn-dark-secondary" onclick="closeEditPanel()">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const panel = document.getElementById('editPanel');
    const form = document.getElementById('editForm');
    const inputProjectId = document.getElementById('projectId');
    const inputTitle = document.getElementById('title');
    const inputType = document.getElementById('type');
    const inputManager = document.getElementById('mangerId');
    const inputStatus = document.getElementById('status');
    const inputStartDate = document.getElementById('startDate');
    const inputEndDate = document.getElementById('endDate');

    const hasValidationErrors = @json($errors->any());
    const projectSidebarOpen = hasValidationErrors ? showSidePannel() : closeEditPanel();

    document.querySelector('.add-btn').addEventListener('click', function () {
        form.reset();
        form.dataset.mode = 'create';
        form.action = "{{ route('admin.projects.store') }}";

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        document.getElementById('submitBtn').textContent = 'Add Project';
        showSidePannel();
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const project = JSON.parse(this.dataset.project);

        inputProjectId.value = project.id;
        inputTitle.value = project.title;
        inputType.value = project.type;
        inputManager.value = project.manager_id;
        inputStatus.value = project.status;
        inputStartDate.value = project.start_date;
        inputEndDate.value = project.end_date;

        form.dataset.mode = 'edit';
        const routeTemplate = "{{ route('admin.projects.update', ['project' => 'dummy-id']) }}";
        // const routeTemplate = form.getAttribute('action'); 
        const updatedRoute = routeTemplate.replace('dummy-id', project.id);
        form.action = updatedRoute;

        // Add PUT method dynamically if not exists
        if (!form.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        }

        document.getElementById('submitBtn').textContent = 'Update Project';
        showSidePannel();
    });
    });

    function closeEditPanel() {
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    const errBlock = document.querySelector("#error-sec");
    if(errBlock) errBlock.remove();
    }

    function showSidePannel() {
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
    }
</script>
@endpush