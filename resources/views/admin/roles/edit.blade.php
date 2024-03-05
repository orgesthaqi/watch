@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Update Role</h5>

        <form action="{{ route('roles.update', $role->id) }}" method="POST" style="margin-top:20px;">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $role->name }}">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Update</button>
            </div>
        </form>
</div>

{{-- <div class="container bg-white rounded-lg shadow p-5 mt-5">
    <h5 class="mb-4">Role Permissions</h5>
    <div>
        @if($role->Permissions)
            <div>
                @foreach($role->Permissions as $permission)
                    <div style="display: inline-block; margin-right: 10px;">
                        <form action="{{ route('roles.permissions.revoke', [$role->id, $permission->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ $permission->name }}</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="container bg-white rounded-lg shadow p-5 mt-5">
    <h5 class="mb-4">Assign Permissions</h5>
    <div>
        <form action="{{ route('roles.permissions', $role->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <select class="form-control" id="permissions" name="permissions">
                        <option value="">Select Permission</option>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Assign</button>
            </div>
        </form>
    </div>
</div> --}}
@endsection
