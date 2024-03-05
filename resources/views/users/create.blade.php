@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Create User</h5>

        <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <label class="form-label mb-3">Role</label>
                <select class="form-select" name="role">
                    <option selected>Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label mb-3">Status</label>
                <select class="form-select" name="status">
                    <option selected>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Save</button>
            </div>
        </form>
</div>
@endsection
