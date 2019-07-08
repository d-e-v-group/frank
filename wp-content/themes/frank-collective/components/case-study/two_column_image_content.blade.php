<article class="case-media" {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}  {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="container" data-appear-text>
        @if($section['image'])
            <div class="img">{{ helper::image($section['image'], 'full') }}</div>
        @endif
        <div class="body">
            @if($section['header'])
                <div class="subtitle">{{ $section['header'] }}</div>
            @endif
            @if(isset($section['content']))
                {{ $section['content'] }}
            @endif
        </div>
    </div>
</article>