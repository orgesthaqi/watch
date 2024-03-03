@extends('layouts.app')

@section('content')
<div class="container p-4">
    <h5 class="mb-4" style="display: flex; justify-content: space-between; align-items: center;">
        <span style="margin-right: auto;">Manage Users</span>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">+ Create</a>
    </h5>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role == 1 ? 'Administrator' : 'User' }}</td>
                <td>
                    @if($user->status == 1)
                        <span class="badge text-bg-success">Active</span>
                    @else
                        <span class="badge text-bg-danger">Inactive</span>
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {!! $users->links('pagination::bootstrap-4') !!}
    </div>
</div>
@endsection
