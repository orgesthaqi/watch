@extends('layouts.app')

@section('content')
<div class="container p-4">
    <h5 class="mb-4" style="display: flex; justify-content: space-between; align-items: center;">
        <span style="margin-right: auto;">Manage Media Items</span>
        <a href="{{ route('media_items.create') }}" class="btn btn-sm btn-primary">+ Create</a>
    </h5>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>UUID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Created At</th>
                @role('admin')<th>Actions</th>@endrole
            </tr>
        </thead>
        <tbody>
            @foreach($media_items as $media_item)
            <tr>
                <td>{{ $media_item->id }}</td>
                <td>{{ $media_item->uuid }}</td>
                <td>{{ $media_item->title }}</td>
                <td>
                    @if($media_item->image)
                        <img src="{{ route('file.show', ['id' => $media_item->uuid, 'filename' => $media_item->image]) }}" alt="{{ $media_item->title }}" style="height: 75px; max-width: 100%;">
                    @endif
                </td>
                <td>{{ $media_item->created_at }}</td>
                <td>
                    @role('admin')
                        <a href="{{ route('media_items.edit', $media_item->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('media_items.destroy', $media_item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    @endrole
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {!! $media_items->links('pagination::bootstrap-4') !!}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this item?')) {
                e.target.submit();
            }
        });
    });
</script>
@endsection
