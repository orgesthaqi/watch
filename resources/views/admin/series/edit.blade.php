@extends('layouts.admin_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Update serie</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content mb-2">
    <div class="container-fluid">
        <div class="card card-default" bis_skin_checked="1">
            <div class="card-header" bis_skin_checked="1">
                <h3 class="card-title">Update</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('series.update', $series->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $series->title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $series->description }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Seasons</label>
                        <input type="text" class="form-control" name="seasons" placeholder="Seasons" value="{{ $series->seasons }}">
                    </div>
                    <button type="submit" class="btn btn-primary" type="button">Update</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection




