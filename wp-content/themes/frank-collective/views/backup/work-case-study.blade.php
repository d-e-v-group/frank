@layout('layouts/master')
@section('body-class', (get_field('has_animated_background')) ? 'animated-background' : false)
@section('content')
<div class="root barba-container" data-namespace="case" data-page-id="Case" data-transition-in="case_in" data-transition-out="case_out" data-page-init="case_init">
    @if(get_field('theme_color_case'))
    <div class="work-animated-background" style="background-color: {{ get_field('theme_color_case') }}"></div>
    @endif
    <div class="case-study-hero" {{ get_field('theme_color_case') ? 'data-hero-background="'.get_field('theme_color_case').'"' : false }}>
        <div class="banner">
            <div class="bg-stretch" style="background-image: url('{{ helper::imageURL(get_field('main_image'), 'full') }}')"></div>
        </div>
        <div class="case-study-intro">
            <div class="container">
                <div class="grid">
                    @if(get_field('tagline'))
                        <div class="tag-line" data-big-header>
                            <h1>{{ get_field('tagline') }}</h1>
                        </div>
                    @endif
                </div>
                <div class="grid">
                    <div class="col-sm-3">
                        @if(get_field('brand_name'))
                            <div data-appear-text>
                                <h3>{{ get_field('brand_name') }}</h3>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-5 col-sm-6">
                        @if(get_field('intro_text'))
                        <div data-appear-text>
                        {{ get_field('intro_text') }}
                        </div>
                        @endif
                        <?php
                            $servicesList = [];
                            if(get_field('services_list') === 'categories') {
                                $term_obj_list = get_the_terms( get_the_ID(), 'service' );
                                if(!empty($term_obj_list)){
                                    $servicesList[] = ['slug' => false, 'label' => $term_obj_list->name];
                                }
                            } else {
                                if(get_field('sections')){
                                    $term_obj_list = get_field('sections');
                                    foreach ($term_obj_list as $index => $item){
                                        if($item['nav_menu_title']){
                                            $servicesList[] = ['slug' => ($item['clickable']) ? 'service-'.$index : false, 'label' => $item['nav_menu_title']];
                                        }
                                    }
                                }
                            }
                        ?>
                        @if(count($servicesList) > 0)
                        <?php
                            $servicesList = array_chunk($servicesList, 3);
                        ?>
                        <div data-appear-text>
                            <h4>Services</h4>
                            <div class="grid info-lists">
                                @foreach($servicesList as $items)
                                <div class="col-xs-6">
                                    <ul class="info-list">
                                        @foreach($items as $item)
                                        <li>
                                            @if($item['slug'])
                                            <a href="#{{$item['slug']}}">
                                            @endif
                                                {{ $item['label'] }}
                                            @if($item['slug'])
                                            </a>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-offset-1 col-sm-3">
                        @if(get_field('website'))
                        <div data-appear-text>
                            <h4>Visit Site</h4>
                            <a href="{{ get_field('website_url') }}" class="link-u">{{ get_field('website') }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="case-study-content default-content">
        <div class="container">
            @if(get_field('content_type') === 'images')
                @include('partials/case-study/images-list')
            @else
                @include('partials/case-study/sections')
            @endif
            <div data-appear-text>
                <div class="link-to-back">
                    <a href="/work/" class="link-u">Back to Work</a>
                </div>
            </div>
        </div>
    </div>
    <div data-appear-block>
    @include('partials/cta/case')
    </div>
</div>
@endsection