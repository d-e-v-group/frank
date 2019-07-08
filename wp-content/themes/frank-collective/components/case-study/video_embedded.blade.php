<div class="video-embedded-section {{ $section['aspect'] }} {{ $section['padding_above'] }}  {{ $section['padding_below'] }}" {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }} data-appear-fade-in>
    <div class="video-container">
        <div class="video-wrapper">
            @if($section['type'] === 'vimeo')
                <iframe id="video{{ $section['video'] }}" src="//player.vimeo.com/video/{{ $section['video'] }}?color=e13237&amp;portrait=0&amp;api=1&amp;player_id=video{{ $section['video_id'] }}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            @else
                <iframe id="video{{ $section['video'] }}" src="https://www.youtube.com/embed/{{ $section['video'] }}?&theme=dark&autohide=2" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            @endif
        </div>
    </div>
</div>