@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Update User</h5>

    <form action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" method="POST" style="margin-top:20px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" name="password" placeholder="********">
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role" required>
                <option selected>Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label mb-3">Status</label>
            <select class="form-select" name="status">
                <option selected>Select Status</option>
                <option value="1" @if($user->status == 1) selected @endif>Active</option>
                <option value="0" @if($user->status == 0) selected @endif>Inactive</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" type="button">Save</button>
        </div>
    </form>
</div>

<div class="container bg-white rounded-lg shadow p-5 mt-5">
    <h5 class="mb-4">Roles</h5>
    <div>
        @if($user->roles)
            <div>
                @foreach($user->roles as $user_role)
                    <div style="display: inline-block; margin-right: 10px;">
                        <form action="{{ route('users.roles.revoke', [$user->id, $user_role->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ $user_role->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="container bg-white rounded-lg shadow p-5 mt-5">
    <h5 class="mb-4">Assign Roles</h5>
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
@endsection
