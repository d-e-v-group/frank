<article class="case-media">
    <div class="container" data-appear-text>
        @if(isset($image))
        <div class="img"><img src="{{ $image }}" alt=""></div>
        @endif
        <div class="body">
            @if(isset($subtitle))
            <div class="subtitle">{{ $subtitle }}</div>
            @endif
            @if(isset($content))
                {{ $content }}
            @endif
        </div>
    </div>
</article>