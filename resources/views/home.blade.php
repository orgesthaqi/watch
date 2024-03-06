@extends('layouts.app')

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel">
                    @foreach ($media_items as $media_item)
                        <div class="item">
                            <div class="work">
                                <div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url({{ route('file.show', ['id' => $media_item->uuid, 'filename' => $media_item->image]) }});">
                                    <a href="#" class="icon d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="setVideoUrl('{{ route('file.show', ['id' => $media_item->uuid, 'filename' => $media_item->path]) }}', '{{ $media_item->title }}')"><span class="bi bi-play" style="font-size:25px;"></span>
                                    </a>
                                </div>
                                <div class="text pt-3 w-100 text-center">
                                    <h3><a href="#" data-bs-toggle="modal" data-bs-target="#videoModal">{{ $media_item->title }}</a></h3>
                                    {{-- <span>Web Design</span> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<div class="album py-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
            @foreach ($media_items as $media_item)
            <div class="item">
                <div class="work work_all">
                    <div class="img d-flex align-items-center justify-content-center rounded" style="background-image: url({{ route('file.show', ['id' => $media_item->uuid, 'filename' => $media_item->image]) }});">
                        <a href="#" class="icon d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="setVideoUrl('{{ route('file.show', ['id' => $media_item->uuid, 'filename' => $media_item->path]) }}', '{{ $media_item->title }}')"><span class="bi bi-play" style="font-size:25px;"></span>
                        </a>
                    </div>
                    <div class="text pt-3 w-100 text-center">
                        <h3><a href="#" data-bs-toggle="modal" data-bs-target="#videoModal">{{ $media_item->title }}</a></h3>
                        {{-- <span>Web Design</span> --}}
                    </div>
                </div>
            </div>
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
                <video id="videoFrame" width="100%" controls>
                    <!-- Changed width to 100% for a bigger video -->
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                </video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modalCloseButton"
                    data-bs-dismiss="modal">Close</button>
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
        videoElement.currentTime = 0;
    })


    function setVideoUrl(url, title) {
        document.getElementById('videoModalTitle').innerHTML = title;
        document.getElementById('videoFrame').src = url;

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
    }

</script>
@endsection
