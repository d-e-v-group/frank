<section class="lead-content text-lead-content padding-{{$section['section_padding']}} {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" data-appear-group>
    @if($section['title'])
        <div class="heading container">
            <div data-appear-group-item>
                <h2>{{ $section['title'] }}</h2>
            </div>
        </div>
    @endif
    @if($section['content'])
        <div class="container" data-appear-group-item>
            <div class="grid">
                <div class="col-sm-10 col-md-6">
                    {{ $section['content'] }}
                </div>
            </div>
        </div>
    @endif
</section>