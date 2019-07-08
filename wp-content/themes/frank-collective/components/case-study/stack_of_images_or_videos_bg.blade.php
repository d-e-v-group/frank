@if($section['media_items'])
    <div class="case-display padding-{{ $section['section_padding'] }} {{ ($section['has_parallax']) ? 'background-parallax' : false }}" style="background-{{ $section['background_type'] }}: {{ ($section['background_type'] === 'color') ? $section['background_color'] : 'url('.helper::imageURL($section['background_image'], 'full').')'}}" {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}>
        @foreach((array)$section['media_items'] as $item)
            @if($item['type'] === 'image')
                @if($item['image'])
                    <div class="case-banner case-display-{{ $item['width'] }} margin-top-{{ $item['margin_top'] }} margin-bottom-{{ $item['margin_bottom'] }}" data-appear-fade-in>
	                    <?php
	                    $width = ($item['image_max_width']) ? $item['image_max_width'] : false
	                    ?>
                        {{ helper::image($item['image'], 'full', ['style' => 'max-width: '.$width.'px' ]) }}
                    </div>
                @endif
            @endif

            @if($item['type'] === 'video')
                @if($item['video'])
                    <?php
                    $width = ($item['image_max_width']) ? $item['image_max_width'] : false
                    ?>
                    <div class="case-banner case-display-{{ $item['width'] }} margin-top-{{ $item['margin_top'] }} margin-bottom-{{ $item['margin_bottom'] }}" data-appear-fade-in>
                        <video autoplay muted loop playsinline {{ ($width) ? 'style="margin-left: auto; margin-right: auto; max-width:'.$width.'px"' : false }}>
                            <source src="{{ $item['video'] }}" type="video/mp4">
                        </video>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endif