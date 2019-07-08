@if($section['media_items'])
<div class="case-banner-wrap {{ !empty($section['decorations']) ? 'with-decor' : false }}" {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}>
    @foreach((array)$section['media_items'] as $item)
        @if($item['type'] === 'image')
            @if($item['image'])
                @if($item['has_mobile_variant'])
                    <div class="case-banner ch-auto cw-{{ $item['width'] }}" data-appear-fade-in>
                        <picture>
                            @if($item['mobile_image'])
                                <source media="(max-width: 767px)" srcset="{{ helper::imageURL($item['mobile_image'], 'full') }}"/>
                            @endif
                                {{ helper::image($item['image'], 'full') }}
                        </picture>
                    </div>
                @else
                    @if($item['height'] === 'auto')
                        <div class="case-banner cw-{{ $item['width'] }}" data-appear-fade-in>
                            {{ helper::image($item['image'], 'full') }}
                        </div>
                    @else
                        <div class="case-banner ch-{{ $item['height'] }} cw-{{ $item['width'] }}" style="background-image: url('{{ helper::imageURL($item['image'], 'full') }}');" data-appear-fade-in></div>
                    @endif
                @endif
            @endif
        @endif

        @if($item['type'] === 'video')
            @if($item['video'])
                @if($item['has_mobile_variant'] && $item['mobile_video'])
                <div class="case-banner ch-auto cw-{{ $item['width'] }}" data-appear-fade-in>
                    <video autoplay muted loop playsinline class="video video-has-mobile" data-video-src="{{ $item['video'] }}" data-mobile-video-src="{{ $item['mobile_video'] }}"></video>
                </div>
                @else
                <div class="case-banner ch-{{ $item['height'] }} cw-{{ $item['width'] }}" data-appear-fade-in>
                    <video autoplay muted loop playsinline class="video">
                        <source src="{{ $item['video'] }}" type="video/mp4">
                    </video>
                </div>
                @endif
            @endif
        @endif
    @endforeach
    @if($section['decorations'])
        @foreach((array) $section['decorations'] as $decor)
            <div class="decor decor-{{ $decor['position'] }}">
                <div data-appear-text>
                    @include('partials/image', ['image' => $decor['image']])
                </div>
            </div>
        @endforeach
    @endif
</div>
@endif