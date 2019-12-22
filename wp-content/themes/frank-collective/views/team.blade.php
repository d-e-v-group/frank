@layout('layouts/master')
<?php /* Template Name: Team */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root" data-page-id="Culture" data-namespace="team" data-transition-in="team_in" data-transition-out="team_out" data-page-init="team_init">
    <!-- <div class="work-animated-background" style="background-color: #CBEEF4"></div> -->
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