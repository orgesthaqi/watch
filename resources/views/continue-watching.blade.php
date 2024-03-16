@extends('layouts.app')

@section('content')

<div class="album py-4">
    <div class="container">
        <div class="section-title pb-4">
            <h4>VAZHDONI SHIKIMIN</h4>
        </div>
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3">
            @foreach ($media_progress as $mp)
            @php
                $progress = $mp->progress ?? 0;
                $duration = $mp->mediaItem->duration;

                if ($progress > 0) {
                    $progress = ($progress / $duration) * 100;
                }
            @endphp

            @if($progress !== 100)
                <div class="col item">
                    <div class="work work_all">
                        <div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url({{ route('file.show', ['id' => $mp->mediaItem->uuid, 'filename' => $mp->mediaItem->image]) }});">
                            <a href="#" class="icon d-flex align-items-center justify-content-center play_video" data-bs-toggle="modal" data-bs-target="#videoModal" data-url="{{ route('file.show', ['id' => $mp->mediaItem->uuid, 'filename' => $mp->mediaItem->path]) }}" data-title="{{ $mp->mediaItem->title }}" data-id="{{ $mp->mediaItem->id }}" data-progress="{{ $mp->mediaItem->userMediaProgress->progress ?? 0 }}" data-views="{{ $mp->mediaItem->views }}"><span class="bi bi-play" style="font-size:25px;"></span>
                            </a>
                        </div>
                        <div class="text pt-3 w-100 text-center">
                            <h3><a href="#" data-bs-toggle="modal" data-bs-target="#videoModal">{{ $mp->mediaItem->title }}</a></h3>
                            <div style="text-align:justify">
                                @foreach ($mp->mediaItem->categories as $category)
                                    <a href="{{ url('/' . strtolower($category->name)) }}" style="text-decoration:none; font-weight:500; font-size:15px; color: #B3B2B3;" class="d-inline">{{ $category->name }}</a>
                                @endforeach
                            </div>

                            <div class="progress" style="height: 5px; margin-top: 10px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModal" aria-hidden="true"
    data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="videoModalTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Added text-center class -->
                <video id="videoFrame" width="100%" controls data-video_id="">
                    <!-- Changed width to 100% for a bigger video -->
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                </video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-eye"></i> <span id="views"></span>
                </button>

                <a href="#" class="btn btn-outline-primary downloadMedia"><i class="bi bi-cloud-download"></i> Download</a>
                <button type="button" class="btn btn-outline-danger" id="modalCloseButton"
                    data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const videoModal = document.getElementById('videoModal')

    videoModal.addEventListener('hidden.bs.modal', event => {
        var videoElement = document.getElementById('videoFrame');
        var videoId = videoElement.getAttribute('data-video_id');
        var videoProgress = videoElement.currentTime;

        var videoItem = document.querySelector('.play_video[data-id="' + videoId + '"]');
        videoItem.setAttribute('data-progress', videoProgress);

        videoElement.pause();

        if (videoProgress > 5) {
            $.ajax({
                url: "{{ route('media.progress') }}",
                method: 'POST',
                data: {
                    media_id: videoId,
                    progress: videoProgress,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log('Progress saved successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Error saving progress:', error);
                }
            });
        }
    })

    $(document).on('click','.play_video',function(){
        var url = $(this).data('url');
        var title = $(this).data('title');
        var id = $(this).data('id');
        var views = $(this).data('views');

        document.getElementById('videoModalTitle').innerHTML = title;
        document.getElementById('videoFrame').src = url;
        document.getElementById('videoFrame').setAttribute('data-video_id', id);
        document.getElementById('views').innerHTML = views + ' views';

        var videoItem = document.querySelector('.play_video[data-id="' + id + '"]');
        var videoProgress = videoItem.getAttribute('data-progress');
        document.getElementById('videoFrame').currentTime = videoProgress;

        var url = "{{ route('media.download', ":id") }}";
        url = url.replace(':id', id);
        document.querySelector('.downloadMedia').href = url;

        const controls = [
            'play-large', // The large play button in the center
            'restart', // Restart playback
            'rewind', // Rewind by the seek time (default 10 seconds)
            'play', // Play/pause playback
            'fast-forward', // Fast forward by the seek time (default 10 seconds)
            'progress', // The progress bar and scrubber for playback and buffering
            'current-time', // The current time of playback
            'duration', // The full duration of the media
            'mute', // Toggle mute
            'volume', // Volume control
            'captions', // Toggle captions
            'settings', // Settings menu
            'fullscreen', // Toggle fullscreen
        ];

        const player = Plyr.setup('#videoFrame', {
            controls
        });

        $.ajax({
            url: "{{ route('media.update-views') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                console.log(response.message);
            }
        });
    });
</script>
@endsection
