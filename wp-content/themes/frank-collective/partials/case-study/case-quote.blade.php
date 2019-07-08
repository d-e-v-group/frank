<blockquote class="case-quote">
    <div class="container" data-appear-block>
        @if($quote['title'])
        <q>{{ $quote['title'] }}</q>
        @endif
        @if($quote['cite'])
        <cite>– {{ $quote['cite'] }}</cite>
        @endif
    </div>
</blockquote>