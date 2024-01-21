<!-- Модальное окно -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <form id="editTaskForm"
                  action="{{route('task.update', [':taskId', 'projectId' => $project->id, 'tasksStatus' => $tasksStatus])}}"
                  method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Task title</label>
                        <input type="text" name="title" class="form-control" id="title">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control" id="description"></textarea>
                    </div>
                    <select name="status" class="form-select" id="status">
                        @foreach(['pending', 'in development', 'on testing', 'on verification', 'completed'] as $status)
                            <option value="{{ $status }}" >
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let editTaskButtons = document.querySelectorAll('.edit-task-btn');
        let form = document.getElementById('editTaskForm');
        let titleInput = document.getElementById('title');
        let descriptionInput = document.getElementById('description');
        let statusSelect = document.getElementById('status');
        const originalFormAction = form.getAttribute('action');

        editTaskButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                let taskId = button.getAttribute('data-task-id');
                let taskTitle = button.getAttribute('data-task-title');
                let taskDescription = button.getAttribute('data-task-description');
                let taskStatus = button.getAttribute('data-task-status');
                form.setAttribute('action', originalFormAction);
                form.action = form.action.replace(':taskId', taskId);
                titleInput.value = taskTitle;
                descriptionInput.value = taskDescription;
                statusSelect.value = taskStatus;
            });
        });
    });
</script>
