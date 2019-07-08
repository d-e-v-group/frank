@if(get_field('section_title'))
<div class="grid">
    <div class="col-sm-7 col-md-5">
        <div data-med-header>
        <h2>{{ get_field('section_title') }}</h2>
        </div>
    </div>
</div>
@endif
@if(get_field('sections'))
    @foreach((array)get_field('sections') as $index => $sections)
        @if($sections['clickable'])
            <div class="row" id="service-{{ $index }}">
                <div class="grid text-row">
                    <div class="col-sm-4 col-md-3 title-col">
                        @if($sections['header'])
                            <div data-appear-text>
                                <h3>{{ $sections['header'] }}</h3>
                            </div>
                        @endif
                        @if($sections['links'])
                            <div data-appear-text>
                            <ul class="links">
                                @foreach((array) $sections['links'] as $link)
                                    <li>@include('partials/link', ['button' => $link['link-u']])</li>
                                @endforeach
                            </ul>
                            </div>
                        @endif
                    </div>
                    @if($sections['content'])
                    <div class="col-sm-9 col-md-6">
                        <div data-appear-text>
                        {{ $sections['content'] }}
                        </div>
                    </div>
                    @endif
                </div>
                @if($sections['images'])
                    <?php
                    $slides = [];
                    foreach ((array)$sections['images'] as $slide){
                        $slides[] = ['title' => $slide['caption'], 'image' => helper::imageURL($slide['image'], 'full')];
                    }
                    $slideshow = [
                        'title' => $sections['images'][0]['caption'],
                        'slides' => $slides
                    ];
                    ?>
                    <div data-appear-text>
                    @include('partials/slideshow', ['data' => compact('slideshow')])
                    </div>
                @endif
            </div>
            @if($sections['enable_quote'] && ($sections['quote'] || $sections['quote_name']))
            <div data-appear-text>
            <div class="testimonial-block">
                <div class="grid">
                    <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                        <blockquote>
                            @if($sections['quote'])
                            <q>{{ $sections['quote'] }}</q>
                            @endif
                            @if($sections['quote_name'])
                            <cite>{{ $sections['quote_name'] }}</cite>
                            @endif
                        </blockquote>
                    </div>
                </div>
            </div>
            </div>
            @endif
        @endif
    @endforeach
@endif