@extends('layouts.admin_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update user</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content mb-2">
    <div class="container-fluid">
        <div class="card card-default" bis_skin_checked="1">
            <div class="card-header" bis_skin_checked="1">
                <h3 class="card-title">Update</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="*******">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Role</label>
                        <select class="form-control" name="role">
                            <option selected>Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option selected>Select Status</option>
                            <option value="1" @if($user->status == 1) selected @endif>Active</option>
                            <option value="0" @if($user->status == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" type="button">Update</button>
                </form>
            </div>
        </div>

        <div class="card card-default" bis_skin_checked="1">
            <div class="card-header" bis_skin_checked="1">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                <div>
                    @if($user->roles)
                        <div>
                            @foreach($user->roles as $user_role)
                                <div style="display: inline-block; margin-right: 10px;">
                                    <form action="{{ route('users.roles.revoke', [$user->id, $user_role->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-ban"></i> {{ $user_role->name }}
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card-default" bis_skin_checked="1">
            <div class="card-header" bis_skin_checked="1">
                <h3 class="card-title">Assign Roles</h3>
            </div>
            <div class="card-body">
                <div>
                    <form action="{{ route('users.roles', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="role">Roles</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="">Select Permission</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" type="button">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

