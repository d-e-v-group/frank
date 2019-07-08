<section class="content-section cs--a {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="container">
        <div class="grid">
            <div class="col-lg-3">
                @if($section['title'])
                <div data-med-header>
                    <h3>{{ $section['title'] }}</h3>
                </div>
                @endif
            </div>
            <div class="col-lg-9">
                @if($section['links_blocks'])
                <div class="content-row">
                    <div class="grid-flex" data-appear-block>
                        @foreach((array)$section['links_blocks'] as $item)
                        <div class="col-sm-6 col-md-4 text-col">
                            @if($item['header'])
                            <h5>{{ $item['header'] }}</h5>
                            @endif
                            @if($item['links'])
                            <ul class="services-list">
                                @foreach((array)$item['links'] as $link)
                                <li>@include('partials/link', ['button' => $link['link']])</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- our-services-section -->