@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Update Category</h5>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" style="margin-top:20px;">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $category->name }}">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Update</button>
            </div>
        </form>
</div>
@endsection
