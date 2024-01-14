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
                    <select class="form-select" aria-label="Пример выбора по умолчанию">
                        <option selected>в ожидании</option>
                        <option value="1">в разработке</option>
                        <option value="2"> на тестировании</option>
                        <option value="3">на проверке</option>
                        <option value="4">выполнено</option>
                    </select>
                </td>
                <td class="col-2">
                    <button class="me-1 btn btn-primary" id="{{$task->id}}">
                        <i class="bi bi-info-circle"></i>
                    </button>
                    <a href="{{ route('project.delete', $task->id)}}">
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
