<section class="frank-work container {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="grid">
        <div class="col-lg-3">
            @if($section['title'])
            <header class="heading" data-med-header>
                <h3>{{ $section['title'] }}</h3>
            </header>
            @endif
        </div>
        <div class="col-lg-9">
            @if($section['works'])
            @foreach((array)$section['works'] as $work)
            <div class="row">
                <div class="grid text-holder">
                    <div class="col-sm-4" data-appear-group>
                        @if($work['header'])
                        <h4 data-appear-group-item>{{ $work['header'] }}</h4>
                        @endif
                    </div>
                    <div class="col-sm-8" data-appear-text>
                        @if($work['content'])
                        {{ $work['content'] }}
                        @endif
                        @if($work['links'])
                        <ul class="links">
                            @foreach((array) $work['links'] as $link)
                            <li data-appear-group-item>@include('partials/link', ['button' => $link['link']])</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                @if($work['slides'])
                <?php
                /*$slides = [];
                foreach ((array)$work['slides'] as $slide){
                    $slides[] = ['title' => $slide['caption'], 'image' => helper::imageURL($slide['image'], 'full')];
                }*/
                $slideshow = [
                    'title' => $work['slides'][0]['caption'],
                    'slides' => (array)$work['slides']
                ];
                ?>
                <div class="slider-holder" data-appear-fade-in>
                    @include('partials/slideshow', ['data' => compact('slideshow')])
                </div>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>