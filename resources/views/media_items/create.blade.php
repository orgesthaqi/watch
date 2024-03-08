@extends('layouts.app')

@section('content')
<div class="container bg-white rounded-lg shadow p-5">
    <h5 class="mb-4">Media Upload</h5>

        <form action="{{ route('media_items.store') }}" enctype="multipart/form-data" method="POST" style="margin-top:20px;">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" name="image" id="customFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Featured</label>
                <select class="form-select" name="featured">
                    <option value="">Select featured</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3" id="upload-container">
                <label for="formFile" class="form-label">File</label>
                <input type="file" id="browseFile" class="form-control"/>
            </div>

            <div class="progress mt-3" style="height: 25px; margin-bottom: 30px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                    style="width: 75%; height: 100%">75%</div>
            </div>

            <input type="hidden" name="media_path" id="media_path">
            <input type="hidden" name="media_item_id" id="media_item_id">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button" style="display: none;">Save</button>
            </div>
        </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
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

</script>
@endsection
