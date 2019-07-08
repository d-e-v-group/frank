<article class="case-intro">
    <div class="container">
        <div class="grid">
            <div class="col-sm-5 col-sm-offset-1" data-appear-block>
                @if(isset($pagetitle))
                <div class="title">{{ $pagetitle }}</div>
                @endif
                @if(isset($subtitle))
                <div class="subtitle"><a href="{{ $link }}" target="_blank">{{ $subtitle }}</a></div>
                @endif
            </div>
            <div class="col-sm-5" data-appear-block>
                @if(isset($h1))
                <h1>{{ $h1 }}</h1>
                @endif
                @if(isset($content))
                    {{ $content }}
                @endif
            </div>
        </div>
    </div>
</article>