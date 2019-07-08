<article class="case-subintro" {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="container">
        <div class="grid">
            <div class="col-sm-5 col-sm-offset-1" data-appear-block>
                @if(isset($section['header']))
                    <h2>{{ $section['header'] }}</h2>
                @endif
            </div>
            <div class="col-sm-5">
                @if($section['content'])
                    @foreach((array)$section['content'] as $text)
                        <div class="text-row" data-appear-block>
                            @if(isset($text['small_header']))
                                <div class="subtitle">{{$text['small_header']}}</div>
                            @endif
                            @if(isset($text['content']))
                                {{$text['content']}}
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</article>
