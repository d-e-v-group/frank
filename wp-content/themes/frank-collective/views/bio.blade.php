@layout('layouts/master')
@section('content')
<div class="root barba-container" data-namespace="bio" data-page-id="Bio" data-transition-in="bio_in" data-transition-out="bio_out" data-page-init="bio_init">
    <div class="work-animated-background" style="background-color: #CBEEF4"></div>
    <div class="main bg-blue animated-background default-content">
        <div class="bio-section">
            <div class="container">
                <div class="grid-flex heading-row">
                    <div class="col-sm-4 col-md-3">
                        <div class="back-link bio-content-left">
                            <a href="/team" data-team-id="{{ get_the_ID() }}"><i class="icon-left-arrow"></i> Back to People</a>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="bio-content-right">
                            <div class="heading">
                                @if(get_field('name'))
                                <h2>{{ get_field('name') }}</h2>
                                @endif
                                @if(get_field('position'))
                                <p>{{ get_field('position') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-sm-4 col-md-3 avatar-col">
                        <div class="bio-content-left">
                            <div class="avatar-wrap">
                                {{ helper::image(get_field('photo'), 'full') }}
                            </div>
                            @if(get_field('socials'))
                                <h4>Social</h4>
                                <ul class="link-list">
                                    @foreach(get_field('socials') as $item)
                                        @if($item['label'])
                                            <li><a href="{{ $item['link'] }}" class="link-u">{{ $item['label'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    @if(get_field('content'))
                    <div class="col-sm-8 col-md-6 desc-col">
                        <div class="bio-content-right">
                            {{ get_field('content') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('partials/cta/contact', ['classes' => 'cta-white'])
</div>
@endsection