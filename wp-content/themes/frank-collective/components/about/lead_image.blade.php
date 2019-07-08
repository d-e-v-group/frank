@if($section['image'])
<section class="lead-image {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="img-full">
        <div class="img" data-appear-fade-in>
            {{ helper::image($section['image'], 'full') }}
        </div>
    </div>
</section>
@endif