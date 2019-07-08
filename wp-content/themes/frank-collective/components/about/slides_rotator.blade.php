<section class="featured-image-section container {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="tbl" data-appear-fade-in>
        @if($section['works'])
            @foreach((array) $section['works'] as $work)
                <div class="bg-stretch">
                    <span data-srcset="{{ helper::imageURL($work['image'], 'full') }}"></span>
                </div>
            @endforeach
        @endif
        <div class="inner">
            <div class="grid">
                <div class="col-sm-8 col-lg-4 col-sm-offset-2" data-appear-block>
                    @if($section['title'])
                        <h3>{{ $section['title'] }}</h3>
                    @endif
                    @include('partials/link', ['button' => get_field('works_cta'), 'classes' => 'link-u'])
                </div>
            </div>
        </div>
    </div>
</section>