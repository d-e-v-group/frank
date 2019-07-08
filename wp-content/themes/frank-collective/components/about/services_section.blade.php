<section class="content-section {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="container">
        <div class="grid">
            <div class="col-lg-3">
                @if($section['title'])
                    <div data-med-header>
                        <h3>{{ $section['title'] }}</h3>
                    </div>
                @endif
            </div>
            <div class="col-lg-8">
                @if($section['services'])
                    @foreach((array) $section['services'] as $service)
                        <div class="content-row" data-appear-group>
                            <div class="head" data-appear-group-item>
                                @if($service['service'])
                                    <h4>{{ $service['service'] }}</h4>
                                @endif
                                @if($service['links'])
                                    <ul class="links" data-appear-group-item>
                                        @foreach((array) $service['links'] as $link)
                                            <li>@include('partials/link', ['button' => $link['link']])</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            @if($service['details'])
                            <div class="grid-flex">
                                @foreach((array)$service['details'] as $detail)
                                <div class="col-sm-6 text-col" data-appear-group-item>
                                    @if($detail['title'])
                                    <h5>{{ $detail['title'] }}</h5>
                                    @endif
                                    @if($detail['text'])
                                    <div>
                                        {{ $detail['text'] }}
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>