<div class="case-partners">
    <div class="container">
        @if(isset($guidetxt))
            <span class="guide-txt"><div data-appear-text>{{ $guidetxt }}</div></span>
        @endif
        <ul class="list" data-appear-block>
            @foreach($logos as $logo)
            <li><a href="#"><img src="{{ $logo['image'] }}" width="{{ $logo['size'] }}" alt=""></a></li>
            @endforeach
        </ul>
    </div>
</div>