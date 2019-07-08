<section class="lead-content {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    @if($section['title'])
        <div class="heading container">
            <div data-med-header>
                <h2>{{ $section['title'] }}</h2>
            </div>
        </div>
    @endif
    @if($section['image'])
        @if(!$section['full_width'])
            <div class="img-container container">
        @endif
        <div class="img-wrap {{ (!$section['full_width']) ? 'add' : false }}" data-appear-fade-in>
            {{ helper::image($section['image'], 'full') }}
        </div>
        @if(!$section['full_width'])
            </div>
        @endif
    @endif
</section>