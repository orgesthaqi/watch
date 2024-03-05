@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Update Permission</h5>

        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" style="margin-top:20px;">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $permission->name }}">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Update</button>
            </div>
        </form>
</div>

<div class="container bg-white rounded-lg shadow p-5 mt-5">
    <h5 class="mb-4">Roles</h5>
    <div>
        @if($permission->roles)
            <div>
                @foreach($permission->roles as $permission_role)
                    <div style="display: inline-block; margin-right: 10px;">
                        <form action="{{ route('permissions.roles.revoke', [$permission->id, $permission_role->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ $permission_role->name }}</button>
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
        <form action="{{ route('permissions.roles', $permission->id) }}" method="POST">
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
