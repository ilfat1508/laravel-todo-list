<table class="table table-striped tasks-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($users))
        @foreach($users as $user)
            <tr>
                <td class="col-1">{{$user->id}}</td>
                <td class="col-4">{{$user->name}}</td>
                <td class="col-4">{{$user->email}}</td>
                <td class="col-2">
                    <button class="me-1 btn btn-success btn-sm edit-task-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editTaskModal"
                            data-task-id="{{$user->id}}"
                            data-task-title="{{$user->title}}"
                            data-task-description="{{$user->description}}">
                        <i class="bi bi-info-circle"></i>
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
