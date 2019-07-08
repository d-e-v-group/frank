<div class="slideshow-wrapper">
    <div class="top-row grid">
        <div class="col-sm-offset-4 col-sm-8 col-md-offset-3 col-md-9">
            <strong class="slideshow-title">{{ $slideshow['title'] }}</strong>
        </div>
    </div>
    <div class="slideshow">
        @foreach((array) $slideshow['slides'] as $slide)
        <div class="slide" data-title="{{ $slide['caption'] }}">
            <div class="img-wrap">
                @if(!isset($slide['content_type']) || $slide['content_type'] === 'image')
                    <img src="{{ helper::imageURL($slide['image'], 'full') }}">
                @endif
                @if($slide['content_type'] === 'video')
                    <video autoplay playsinline muted loop class="slide-video">
                        <source src="{{ $slide['video'] }}" type="video/mp4">
                    </video>
                @endif
                @if($slide['content_type'] === 'vimeo')
                    <div class="slide-video-embedded">
                        <div class="video-container">
                            <div class="video-wrapper" style="padding-top: {{ ($slide['aspect_ratio_vertical'] ? $slide['aspect_ratio_vertical'] : 16 ) / ($slide['aspect_ratio_horizontal'] ? $slide['aspect_ratio_horizontal'] : 9) * 100 }}%">
                                <iframe id="video{{ $slide['embedded_id'] }}" src="//player.vimeo.com/video/{{ $slide['embedded_id'] }}?color=e13237&amp;portrait=0&amp;api=1&amp;player_id=video{{ $slide['embedded_id'] }}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                @endif
                @if($slide['content_type'] === 'yt')
                    <div class="slide-video-embedded">
                        <div class="video-container">
                            <div class="video-wrapper" style="padding-top: {{ ($slide['aspect_ratio_vertical'] ? $slide['aspect_ratio_vertical'] : 16 ) / ($slide['aspect_ratio_horizontal'] ? $slide['aspect_ratio_horizontal'] : 9) * 100 }}%">
                                <iframe class="slide-video-embedded" id="video{{ $slide['embedded_id'] }}" src="https://www.youtube.com/embed/{{ $slide['embedded_id'] }}?&theme=dark&autohide=2" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>