
@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{'Project: '   . $project->title}}</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Главная
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">Профиль
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">Контакт
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                    <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form action="{{route('task.store', $project->id)}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="title" class="form-label">Название проекта</label>
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
                            <input type="text" name="status" class="form-control" id="status">
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
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

            // Если есть ошибки, показываем модальное окно
            if (hasTitleError) {
                let createProjectButton = document.getElementById('createTaskModalButton');
                createProjectButton.click();
            }
        });
    </script>
@endsection
