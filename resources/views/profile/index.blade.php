@extends('layouts.app')

@section('content')

<div class="container bg-white rounded-lg shadow p-5">
    @include('includes.alerts')

    <h5 class="mb-4">Update Profile</h5>

        <form action="{{ route('profile.update') }}" method="POST" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ auth()->user()->email }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" name="password" placeholder="********">
            </div>
            @if(auth()->user()->role == 1)
                <div class="mb-3">
                    <label class="form-label mb-3">Role</label>
                    <select class="form-select" name="role">
                        <option selected>Select Role</option>
                        <option value="1" @if(auth()->user()->role == 1) selected @endif>Administrator</option>
                        <option value="2" @if(auth()->user()->role == 2) selected @endif>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label mb-3">Status</label>
                    <select class="form-select" name="status">
                        <option selected>Select Status</option>
                        <option value="1" @if(auth()->user()->status == 1) selected @endif>Active</option>
                        <option value="0" @if(auth()->user()->status == 0) selected @endif>Inactive</option>
                    </select>
                </div>
            @endif
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Update</button>
            </div>
        </form>
</div>
@endsection
