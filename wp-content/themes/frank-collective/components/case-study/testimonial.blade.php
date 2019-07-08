@if($section['name'] || $section['quote'])
<blockquote class="case-quote" {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="container" data-appear-block>
        @if($section['quote'])
            <q>{{ $section['quote'] }}</q>
        @endif
        @if($section['name'])
            <cite>– {{ $section['name'] }}</cite>
        @endif
    </div>
</blockquote>
@endif