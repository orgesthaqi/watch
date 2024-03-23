@extends('layouts.admin_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Series</h1>
            </div>
            <div class="col-sm-6" bis_skin_checked="1">
                <a href="{{ route('series.create') }}" class="btn btn-outline-dark float-right">Create</a>
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
                                    <th>Description</th>
                                    <th>Seasons</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($series as $serie)
                                <tr>
                                    <td>{{ $serie->id }}</td>
                                    <td>{{ $serie->title }}</td>
                                    <td>{{ $serie->desciption }}</td>
                                    <td>{{ $serie->seasons }}</td>
                                    <td>{{ $serie->created_at }}</td>
                                    <td>
                                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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
