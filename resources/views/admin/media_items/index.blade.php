@extends('layouts.admin_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Media Items</h1>
            </div>
            <div class="col-sm-6" bis_skin_checked="1">
                <a href="{{ route('media_items.create') }}" class="btn btn-outline-dark float-right">Create</a>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <section class="col-lg-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Rating</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    @role('admin')<th>Feature</th>@endrole
                                    @role('admin')<th>Actions</th>@endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mediaItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><i class="fas fa-star"></i> {{ number_format(rand(1, 10), 1) }}</td>
                                    <td>{{ $item->type == 1 ? 'Movie' : 'Serie' }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>Visible</td>
                                    <td>{{ $item->created_at }}</td>
                                    @role('admin')
                                        <td>
                                            <label class="checkbox_container">
                                                <input type="checkbox" value="{{ $item->id }}" {{ $item->featured ? 'checked' : '' }} onchange="updateFeatured({{ $item->id }}, this.checked)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                        <a href="{{ route('media_items.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('media_items.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endrole
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
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

    function updateFeatured(id, featured) {
        $.ajax({
            url: "{{ route('media_items.featured') }}",
            type: 'POST',
            data: {
                id: id,
                featured: featured ? 1 : 0,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Response:', response);
            }
        });
    }

    // $('.media_item_sort').on('blur', function(e){
    //     var id = $(this).data('id');
    //     var sort_id = $(this).html();
    //     var current_sort_id = $(this).data('current_sort_id');

    //     if (parseInt(sort_id) === parseInt(current_sort_id)) {
    //         return;
    //     }

    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('media_items.sort') }}",
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             id: id,
    //             sort_id: sort_id,
    //         },
    //         success: function (data) {
    //             if (data.status == '200') {
    //                 $('.media_item_sort[data-id="' + id + '"]').data('current_sort_id', sort_id);
    //                 toastr.success('Item successfully updated!', 'Success');
    //             }
    //         },
    //         error: function(data) {
    //             toastr.error('Error updating item!', 'Error');
    //         }
    //     });
    // });
</script>
@endsection
