@extends('layouts.admin_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Media Item</h1>
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
                <h3 class="card-title">Add new item</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('media_items.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title"></input>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput10" class="form-label">Image</label>
                        <div class="custom-file" bis_skin_checked="1">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile" id="customFileLabel">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Featured</label>
                        <select class="custom-select" name="featured">
                            <option value="">Select featured</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formFile" class="form-label">Type</label>
                        <div class="col-auto mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="1"
                                    id="movieCheckbox" checked>
                                <label class="form-check-label" for="movieCheckbox">
                                    Movie
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="2"
                                    id="serieCheckbox">
                                <label class="form-check-label" for="serieCheckbox">
                                    Serie
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="serieContainer" style="display: none;">
                        <label for="formFile" class="form-label">Serie</label>
                        <div class="input-group">
                            <select class="selectpicker series col-11" name="serie_id" data-live-search="true">
                                <option value="">Select serie</option>
                                @foreach($series as $serie)
                                <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary col-1" type="button" id="addSerieButton" data-toggle="modal" data-target="#modal-default">+</button>
                        </div>
                    </div>
                    <div class="form-group" id="episodeContainer" style="display: none;">
                        <label for="formFile" class="form-label">Episode Number</label>
                        <select class="custom-select" name="episode_number">
                            <option value="">Select episode number</option>
                            @for($i = 1; $i <= 15; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group" id="seasonContainer" style="display: none;">
                        <label for="formFile" class="form-label">Season Number</label>
                        <select class="custom-select" name="season_number">
                            <option value="">Select season number</option>
                            @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group" id="categoriesContainer">
                        <label for="formFile" class="form-label">Categories</label>
                        <div class="row">
                            @foreach($categories as $category)
                            <div class="col-auto mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                        value="{{ $category->id }}" id="category{{ $category->id }}">
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group" id="upload-container">
                        <div class="custom-file" bis_skin_checked="1">
                            <input type="file" class="custom-file-input" id="browseFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class="progress mt-3 progress-media" style="height: 25px; margin-bottom: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                            style="width: 75%; height: 100%">75%</div>
                    </div>

                    <input type="hidden" name="media_path" id="media_path">
                    <input type="hidden" name="media_item_id" id="media_item_id">
                    <input type="hidden" name="media_item_duration" id="media_item_duration">
                    <button type="submit" class="btn btn-primary btn-block col-12" style="display: none;">Save</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modal-default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" bis_skin_checked="1">
                    <h4 class="modal-title">New Serie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tvShowForm" action="{{ route('series.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="seasons">Seasons:</label>
                            <input type="number" class="form-control" id="seasons" name="seasons" min="1" required>
                        </div>
                        <input type="hidden" name="from_media_item_form" value="1">
                        <div class="mb-3"></div>
                        <button type="submit" class="btn btn-primary btn-block col-12">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
    // Bootstrap select picker
    $.fn.selectpicker.Constructor.DEFAULTS.styleBase = 'form-control';
    $.fn.selectpicker.Constructor.DEFAULTS.style = '';
    $('.series').selectpicker();
    // End Bootstrap select picker

    document.getElementById('customFile').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        document.getElementById('customFileLabel').textContent = fileName;
    });

    let browseFile = $('#browseFile');

    let resumable = new Resumable({
        target: '{{ route('media_items.files.upload') }}',
        chunkSize: 10 * 1024 * 1024,
        testChunks: false,
        simultaneousUploads: 3,
        throttleProgressCallbacks: 1,
        forceChunkSize: true,
        query: { _token: '{{ csrf_token() }}'},
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response);

        $('button[type="submit"]').show();
        $('#media_path').val(response.filename);
        $('#media_item_id').val(response.mediaItemId);
        $('#media_item_duration').val(response.duration);
        $('.card-footer').show();
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert('file uploading error.')
    });


    let progress = $('.progress');

    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }

    $('input[name="type"]').change(function () {
        if ($(this).val() == 2) {
            $('#serieContainer').show();
            $('#episodeContainer').show();
            $('#seasonContainer').show();
            $('#categoriesContainer').hide();
        } else {
            $('#serieContainer').hide();
            $('#episodeContainer').hide();
            $('#seasonContainer').hide();
            $('#categoriesContainer').show();
            $('select[name="serie_id"]').val('');
            $('select[name="serie_id"]').selectpicker("refresh");
            $('select[name="episode_number"]').val('');
            $('select[name="season_number"]').val('');
            $('input[name="categories[]"]').prop('checked', false);
        }
    });
</script>
@endsection
