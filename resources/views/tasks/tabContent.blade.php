<table class="table table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($tasks))
        @foreach($tasks as $task)
            <tr>
                <td class="col-4">{{$task->title}}</td>
                <td class="col-4">{{$task->description}}</td>
                <td class="col-2">
                    <select class="form-select">
                        @foreach(['pending', 'in development', 'on testing', 'on verification', 'completed'] as $status)
                            <option value="{{ $status }}" {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="col-2">
                    <button class="me-1 btn btn-primary" id="{{$task->id}}">
                        <i class="bi bi-info-circle"></i>
                    </button>
                    <a href="{{ route('task.delete', ['taskId' => $task->id, 'projectId' => $project->id]) }}">
                        <button class="me-1 btn btn-outline-danger"
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
