@if($section['header'] || $section['partners'])
<div class="case-partners" {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }} {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}>
    <div class="container">
        @if($section['header'])
            <span class="guide-txt"><div data-appear-text>{{ $section['header'] }}</div></span>
        @endif
        @if($section['partners'])
        <ul class="list" data-appear-block>
            @foreach((array) $section['partners'] as $logo)
                <li>
                    <a href="{{ $logo['link'] }}">
                        {{ Helper::image($logo['partner']['image'], 'full', ['width' => (($logo['partner']['image_width'] && (int)$logo['partner']['image_width'] > 0) ? $logo['partner']['image_width'] : '')]) }}
                    </a>
                </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>
@endif