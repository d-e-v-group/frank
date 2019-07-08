<section class="our-location-section {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
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
                @if($section['locations'])
                    <div class="locations-switcher" data-appear-text="">
                        @foreach((array) $section['locations'] as $index => $location)
                            <div class="content-row location-item" id="location-{{ $index }}">
                                <div class="text-row grid">
                                    @if($location['title'])
                                        <div class="col-md-4">
                                            <div class="location-switcher-nav">
                                                @foreach((array) $section['locations'] as $idx => $location_item)
                                                <a href="#" data-href="#location-{{ $idx }}" class="place {{ ($idx === $index) ? 'active' : false }}">{{ $location_item['title'] }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <div class="infos">
                                            @if($location['contact'])
                                                <div class="info-row">
                                                    <h5>Contact</h5>
                                                    <a href="mailto:{{ $location['contact'] }}" class="link-u">{{ $location['contact'] }}</a>
                                                </div>
                                            @endif
                                            @if($location['contact'])
                                                <div class="info-row">
                                                    <h5>Amenities</h5>
                                                    <p>{{ $location['amenities'] }}</p>
                                                </div>
                                            @endif
                                            @if($location['features'])
                                                <ul class="feat-list grid-flex">
                                                    @foreach((array) $location['features'] as $feature)
                                                        <li class="col-sm-6">
                                                            <strong>{{ $feature['feature'] }}</strong> {{ $feature['value'] }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($location['image'])
                                    <div class="img-holder">
                                        <div class="img" data-appear-fade-in>
                                            {{ helper::image($location['image'], 'full') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>