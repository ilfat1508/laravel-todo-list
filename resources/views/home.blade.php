@extends('layouts.app')

@section('content')
    @if(auth()->user()->role === 'admin')
        @include('users.container')
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">{{ __('Projects') }}
                        <button class="btn btn-success btn-sm" id="createProjectModalButton" data-bs-toggle="modal"
                                data-bs-target="#createProjectModal">
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

                        <ul class="nav nav-tabs w-100">
                            <li class="nav-item ">
                                <a class="nav-link active" aria-current="page" href="#">List</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home">
                                <div class="container">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($projects))
                                            @foreach($projects as $project)
                                                <tr>
                                                    <td class="col-5">{{$project->id}}</td>
                                                    <td class="col-5">{{$project->title}}</td>
                                                    <td class="col-5">{{$project->description}}</td>
                                                    <td class="col-2" style="white-space: nowrap;">
                                                        <a href="{{route('project.show', $project->id)}}">
                                                            <button class="me-1 btn btn-primary btn-sm">
                                                                <i class="bi bi-info-circle"></i>
                                                            </button>
                                                        </a>
                                                        <button class="me-1 btn btn-success btn-sm edit-project-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editProjectModal"
                                                                data-project-id="{{$project->id}}"
                                                                data-project-title="{{$project->title}}"
                                                                data-project-description="{{$project->description}}"
                                                        >
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <a href="{{ route('project.delete', $project->id)}}">
                                                            <button class="me-1 btn btn-outline-danger btn-sm">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form action="{{route('project.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Project title</label>
                            <input type="text" name="title" class="form-control" id="title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" name="description" class="form-control" id="description"></textarea>
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

    @include('project.editingModal')

    <script>
        // Добавляем скрипт после вашего кода HTML

        document.addEventListener('DOMContentLoaded', function () {
            // Проверяем, есть ли ошибки валидации при загрузке страницы
            let hasTitleError = @json($errors->has('title'));

            // Если есть ошибки, показываем модальное окно
            if (hasTitleError) {
                let createProjectButton = document.getElementById('createProjectModalButton');
                createProjectButton.click();
            }
        });
    </script>
@endsection
