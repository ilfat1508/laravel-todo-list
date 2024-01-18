<!-- Модальное окно -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <form id="editProjectForm" action="{{route('project.update', ':id')}}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Project title</label>
                        <input type="text" name="title" class="form-control" value="{{$project->title}}" id="title">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" name="description" class="form-control" id="description">{{$project->description}}</textarea>
                    </div>
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
        let editProjectButtons = document.querySelectorAll('.edit-project-btn');
        let form = document.getElementById('editProjectForm');
        editProjectButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                let projectId = button.getAttribute('data-project-id');
                form.action = form.action.replace(':id', projectId);
            });
        });
    });
</script>
