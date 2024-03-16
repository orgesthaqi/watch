@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Create Series</h5>

        <form action="{{ route('series.store') }}" method="POST" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description">
            </div>
            <div class="mb-3">
                <label class="form-label">Seasons</label>
                <input type="number" class="form-control" name="seasons" placeholder="Seasons">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Save</button>
            </div>
        </form>
</div>
@endsection
