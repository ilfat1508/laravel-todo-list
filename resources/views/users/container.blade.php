<div class="container users-container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="nav nav-tabs w-100">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                    id="all-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#all"
                                    type="button"
                                    role="tab"
                                    data-status="all"
                                    aria-controls="all"
                                    aria-selected="true">
                                Users
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home">
                            <div class="container">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="col-2">{{$user->id}}</td>
                                                <td class="col-4">{{$user->name}}</td>
                                                <td class="col-4">{{$user->email}}</td>
                                                <td class="col-4">{{$user->role}}</td>
                                                <td class="col-2" style="white-space: nowrap;">
                                                    <button class="me-1 btn btn-outline-danger btn-sm"
                                                            onclick="deleteUser({{ $user->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <button class="me-1 btn btn-outline-danger btn-sm"
                                                            onclick="blockUser({{ $user->id }})">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </button>
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

<form id="user-action-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="user_id" id="user-id-input">
</form>

<script>
    function deleteUser(userId) {
        document.getElementById('user-id-input').value = userId;
        document.getElementById('user-action-form').action = "{{ route('user.destroy', '') }}" + '/' + userId;
        document.getElementById('user-action-form').submit();
    }

    function blockUser(userId) {
        // Аналогично для блокировки пользователя
        document.getElementById('user-id-input').value = userId;
        document.getElementById('user-action-form').action = "{{ route('user.lock', '') }}" + '/' + userId;
        document.getElementById('user-action-form').submit();
    }
</script>
