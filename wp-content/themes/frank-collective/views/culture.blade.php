@layout('layouts/master')
<?php /* Template Name: Culture */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root" data-page-id="Culture" data-namespace="culture" data-transition-in="culture_in" data-transition-out="culture_out" data-page-init="culture_init">
    <div class="work-animated-background" style="background-color: #CBEEF4"></div>
    <div class="page-article">
        <div class="inner-wrap">
            <div class="container">
                <div class="grid">
                    <div class="col-md-8">
                        @if(get_field('hero_header'))
                        <div data-big-header>
                            <h1>{{ get_field('hero_header') }}</h1>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="grid">
                    @if(get_field('hero_text'))
                        <div class="col-sm-8 col-lg-6 intro-txt" data-appear-block>
                            {{ get_field('hero_text') }}
                        </div>
                    @endif
                    <div class="col-sm-3 col-sm-offset-1">
                        <nav class="page-nav" data-appear-group>
                            @if(get_field('hero_nav_title'))
                            <h6 class="title" data-appear-group-item>{{ get_field('hero_nav_title') }}</h6>
                            @endif
                            <ul>
                                @if(get_field('culture_title'))
                                <li data-appear-group-item><a href="#our-culture" class="link-u">{{ get_field('culture_title') }}</a></li>
                                @endif
                                @if(get_field('team_title'))
                                <li data-appear-group-item><a href="#our-people" class="link-u">{{ get_field('team_title') }}</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(get_field('office'))
        <div class="banner banner-office">
            @foreach((array)get_field('office') as $index => $item)
            <div class="bg-img" id="img-{{ $index }}" style="background-image: url('{{ helper::imageURL($item['image'], 'full') }}');"></div>
            @endforeach
            <div class="container">
                <ul class="banner-office-links">
                    @foreach((array)get_field('office') as $index => $item)
                    <li class="{{ ($index === 0) ? 'active' : false }}active"><a href="#img-{{ $index }}">{{ $item['city'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="section-culture" id="our-culture">
        <div class="container">
            <div class="intro">
                @if(get_field('culture_header'))
                <h3>{{ get_field('culture_header') }}</h3>
                @endif
                <div class="grid">
                    <div class="col-sm-6 col-md-5">
                        {{ get_field('culture_content_left') }}
                    </div>
                    <div class="col-sm-6 col-md-5 col-md-offset-1">
                        {{ get_field('culture_content_right') }}
                    </div>
                </div>
            </div>

            @if(get_field('images'))
            <ul class="collage" data-appear-block="fade-in">
                @foreach((array) get_field('images') as $item)
                <li>{{ helper::image($item['image'], 'full') }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    <section class="team-section culture--a" id="our-people">
        <div class="container">
            <div class="intro">
                @if(get_field('team_header'))
                <div data-med-header>
                    <h2>{{ get_field('team_header') }}</h2>
                </div>
                @endif
                @if(get_field('team_subheader') || get_field('team_text'))
                <div class="grid">
                    @if(get_field('team_subheader'))
                    <div class="col-sm-3">
                        <h4 data-appear-text>{{ get_field('team_subheader') }}</h4>
                    </div>
                    @endif
                    @if(get_field('team_text'))
                    <div class="col-sm-6" data-appear-block>
                        {{ get_field('team_text') }}
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="team-list">
                @if(get_field('team_top'))
                <div class="grid grid-flex" data-appear-block>
                    <?php
                    $options = array(
                        'post_type' => 'team',
                        'orderby' => 'post__in',
                        'post__in' => get_field('team_top'),
                        'posts_per_page' => -1
                    );
                    $team = new WP_Query( $options );
                    while( $team->have_posts() ) : $team->the_post();
                    ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 team-item" data-appear-block data-animation-delay="0.3">
                            @if(get_field('disable_bio_page'))
                                <div>
                            @else
                                <a href="{{ get_permalink() }}">
                            @endif
                                <span class="avatar-wrap enable-hover" data-preload-image="{{ Helper::imageUrl(get_field('photo_hover'), 'full') }}">
                                    <span class="photo-placeholder">
                                        <span class="inner-content" style="background-image:url({{ Helper::imageUrl(get_field('photo'), 'full') }})"></span>
                                    </span>
                                    <span class="photo-placeholder hover">
                                        <span class="inner-content" style="background-image:url({{ Helper::imageUrl((get_field('photo_hover')) ? get_field('photo_hover') : get_field('photo'), 'full') }})"></span>
                                    </span>
                                </span>
                                <strong class="name">{{ get_field('name') }}</strong>
                                <span class="post">{{ get_field('position') }}</span>
                            @if(get_field('disable_bio_page'))
                                </div>
                            @else
                                </a>
                            @endif
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                @endif
                @if(get_field('team_bottom'))
                <div class="grid grid-flex" data-appear-block>
                    <?php
                    $options = array(
                        'post_type' => 'team',
                        'orderby' => 'post__in',
                        'post__in' => get_field('team_bottom'),
                        'posts_per_page' => -1
                    );
                    $team = new WP_Query( $options );
                    while( $team->have_posts() ) : $team->the_post();
                    ?>
                    <div class="col-xs-6 col-sm-4 col-md-3 team-item" data-appear-block data-animation-delay="0.3">
                        @if(get_field('disable_bio_page'))
                        <div>
                        @else
                        <a href="{{ get_permalink() }}">
                        @endif
                            <span class="avatar-wrap enable-hover" data-preload-image="{{ Helper::imageUrl(get_field('photo_hover'), 'full') }}">
                                    <span class="photo-placeholder">
                                        <span class="inner-content" style="background-image:url({{ Helper::imageUrl(get_field('photo'), 'full') }})"></span>
                                    </span>
                                    <span class="photo-placeholder hover">
                                        <span class="inner-content" style="background-image:url({{ Helper::imageUrl((get_field('photo_hover')) ? get_field('photo_hover') : get_field('photo'), 'full') }})"></span>
                                    </span>
                            </span>
                        <strong class="name">{{ get_field('name') }}</strong>
                        <span class="post">{{ get_field('position') }}</span>
                        @if(get_field('disable_bio_page'))
                        </div>
                        @else
                        </a>
                        @endif
                    </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                @endif
            </div>
        </div>
    </section>
    @include('partials/cta/contact')
    @include('partials/modal')
</div>
<?php endwhile; ?>
@endsection