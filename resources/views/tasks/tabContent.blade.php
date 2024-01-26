<table class="table table-striped tasks-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($tasks))
        @foreach($tasks as $task)
            <tr>
                <td class="col-1">{{$task->id}}</td>
                <td class="col-4">{{$task->title}}</td>
                <td class="col-4">{{$task->description}}</td>
                <td class="col-2">
                    <select class="form-select task-status-select" id="taskStatusSelect" data-task-id="{{ $task->id }}" data-project-id="{{ $project->id }}">
                        @foreach(['pending', 'in development', 'on testing', 'on verification', 'completed'] as $status)
                            <option value="{{ $status }}" {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="col-2" style="white-space: nowrap">
                    <button class="me-1 btn btn-success btn-sm edit-task-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editTaskModal"
                            data-task-id="{{$task->id}}"
                            data-task-title="{{$task->title}}"
                            data-task-description="{{$task->description}}"
                            data-task-status="{{$task->status}}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <a href="{{ route('task.delete', ['taskId' => $task->id, 'projectId' => $project->id]) }}">
                        <button class="me-1 btn btn-outline-danger btn-sm"
                                id="{{$task->id}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

@include('tasks.editingModal')
