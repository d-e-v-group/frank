<section class="our-team-section container {{ $section['trigger_hide_background'] ? 'trigger-hide-background' : false }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}" id="{{ $section['acf_fc_layout'] }}-{{ $section_index }}">
    <div class="grid intro-row">
        @if($section['title'])
        <div class="col-sm-6" data-med-header>
            <h3>{{ $section['title'] }}</h3>
        </div>
        @endif
        @if($section['text'])
        <div class="col-sm-6" data-appear-text>
            {{ $section['text'] }}
        </div>
        @endif
    </div>
    @if($section['team'])
    <div class="team-list grid" data-appear-block>
        @foreach((array) $section['team'] as $item)
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="avatar-wrap">
                <span class="photo-placeholder">
                    <span class="inner-content" style="background-image:url({{ Helper::imageUrl($item['photo'], 'full') }})"></span>
                </span>
            </div>
            <strong class="name">{{ $item['name'] }}</strong>
            <span class="post">{{ $item['position'] }}</span>
        </div>
        @endforeach
    </div>
    @endif
    <div data-appear-text>
        @include('partials/link', ['button' => $section['link'], 'classes' => 'link-u'])
    </div>
</section>