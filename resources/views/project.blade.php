@extends('layouts.app')

@section('content')
        <div class="container project-container" data-tasks-status="{{ $tasksStatus ? $tasksStatus : '' }}">
        <h3>{{'Project: '   . $project->title}}</h3>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">{{ __('Tasks') }}
                        <button class="btn btn-success btn-sm" id="createTaskModalButton" data-bs-toggle="modal"
                                data-bs-target="#createTaskModal">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    @if(isset($projectCreated) && $projectCreated)
                        <div>{{$projectCreated}}</div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul class="nav tasks-nav-list nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if($tasksStatus === 'all' || $tasksStatus === null) active @endif"
                                        id="all-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#all"
                                        data-project-id="{{$project->id}}"
                                        type="button"
                                        role="tab"
                                        data-status="all"
                                        aria-controls="all"
                                        aria-selected="true">
                                    All
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if($tasksStatus === 'active') active @endif"
                                        id="active-tab"
                                        data-bs-toggle="tab"
                                        data-project-id="{{$project->id}}"
                                        data-bs-target="#active"
                                        data-status="active"
                                        type="button"
                                        role="tab"
                                        aria-controls="active"
                                        aria-selected="false">
                                    Active
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if($tasksStatus === 'completed') active @endif"
                                        id="completed-tab"
                                        data-bs-toggle="tab"
                                        data-status="completed"
                                        data-project-id="{{$project->id}}"
                                        data-bs-target="#completed"
                                        type="button"
                                        role="tab"
                                        aria-controls="completed"
                                        aria-selected="false">
                                    Completed
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                @include('tasks.tabContent')
                            </div>
                            <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                                @include('tasks.tabContent')
                            </div>
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                @include('tasks.tabContent')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="taskModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('task.store', $project->id)}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="description">
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" selected>pending</option>
                                <option value="in development">in development</option>
                                <option value="on testing">on testing</option>
                                <option value="on verification">on verification</option>
                                <option value="completed">completed</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Добавляем скрипт после вашего кода HTML

        document.addEventListener('DOMContentLoaded', function () {
            // Проверяем, есть ли ошибки валидации при загрузке страницы
            let hasTitleError = @json($errors->has('title'));
            let hasDescriptionError = @json($errors->has('description'));

            if (hasTitleError, hasDescriptionError) {
                let createProjectButton = document.getElementById('createTaskModalButton');
                createProjectButton.click();
            }
        });
    </script>
@endsection
