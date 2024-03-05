@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Create Role</h5>

        <form action="{{ route('roles.store') }}" method="POST" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Save</button>
            </div>
        </form>
</div>
@endsection
