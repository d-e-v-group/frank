<article class="case-subintro" {{ isset($section_id) ? 'id="'.$section_id.'"' : false }} {{ isset($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="container">
        <div class="grid">
            <div class="col-sm-5 col-sm-offset-1" data-appear-block>
                @if(isset($h2))
                <h2>{{ $h2 }}</h2>
                @endif
            </div>
            <div class="col-sm-5">

                @foreach($textrow as $text)
                    <div class="text-row" data-appear-block>
                        @if(isset($text['subtitle']))
                        <div class="subtitle">{{$text['subtitle']}}</div>
                        @endif
                        @if(isset($text['content']))
                            {{$text['content']}}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</article>