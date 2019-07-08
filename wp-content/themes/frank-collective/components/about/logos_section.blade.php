<section class="clients-section {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="container">
        @if($section['title'])
            <div data-appear-block>
                <h3>{{ $section['title'] }}</h3>
            </div>
        @endif
        @if($section['clients'])
            <ul class="logos-list grid-flex-center" data-appear-block="fade-in" data-animation-delay="0.06">
                @foreach((array)$section['clients'] as $item)
                    <li class="col-xs-4 col-sm-3 col-md-2">
                        @include('partials/image', ['image' => $item['logo']])
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>