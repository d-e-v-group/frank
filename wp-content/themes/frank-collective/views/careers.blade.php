@layout('layouts/master')
<?php /* Template Name: Careers */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="careers" data-page-id="Careers" data-transition-in="careers_in" data-transition-out="careers_out" data-page-init="careers_init">
    <div class="main default-content">
        <section class="career-section container">
            <div class="intro-block">
                @if(get_field('hero_header'))
                <div class="heading grid">
                    <div class="col-md-10 col-lg-8">
                        <div data-appear-text>
                            <h1>{{ get_field('hero_header') }}</h1>
                        </div>
                    </div>
                </div>
                @endif
                @if(get_field('hero_text'))
                <div class="text-content grid">
                    <div class="col-md-8 col-lg-6" data-appear-block>
                        {{ get_field('hero_text') }}
                    </div>
                </div>
                @endif
            </div>
	        <?php
	        $args = array(
		        'post_type' => ['career'],
		        'post_status' => ['publish'],
		        'orderby' => 'menu_order',
		        'order' => 'ASC',
		        'posts_per_page' => -1,
	        );
	        $postIndex = 0;
	        $query_works = new WP_Query( $args );
	        ?>
            @if($query_works->have_posts())
            <div class="media-container">
                <div class="top-row">
                    @if(get_field('pos_header'))
                    <h2 data-appear-text>{{ get_field('pos_header') }}</h2>
                    @endif
                    <strong class="filter">Filter by <a href="#" class="link-u">All</a></strong>
                </div>
                <div class="media-group">
                    <div class="media-group">
                        <?php
                        while ( $query_works->have_posts() ) : $query_works->the_post();
                        ?>
                            <div class="media grid-flex" data-appear-text>
                                <div class="col-sm-3">
                                    <div class="box">
                                        <strong class="place">{{ get_field('label') }}</strong>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="text-content">
                                        <div class="frame">
                                            <?php $term_obj_list = get_the_terms( get_the_ID(), 'city' );?>
                                            @if($term_obj_list)
                                            <h5>{{ $term_obj_list[0]->name }}</h5>
                                            @endif
                                            <h4 class="title">{{ get_field('position') }}</h4>
                                            <a href="{{ get_permalink() }}" class="link-u">Details and Application</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $postIndex ++ ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            @endif
            <div class="content-image-block grid-flex-center">
                <div class="col-sm-6">
                    @if(get_field('culture_header') || get_field('culture_text'))
                    <div class="text-wrap" data-appear-text>
                        @if(get_field('culture_header') || get_field('culture_text'))
                            <div>
                                <h3>{{ get_field('culture_header') }}</h3>
                            </div>
                        @endif
                            <div>
                            @if(get_field('culture_header') || get_field('culture_text'))
                                {{ get_field('culture_text') }}
                            @endif
                            @include('partials/link', ['button' => get_field('culture_link'), 'classes' => 'link-u'])
                        </div>
                    </div>
                    @endif
                </div>
                @if(get_field('culture_image'))
                <div class="col-sm-6">
                    <div class="img-wrap" data-appear-fade-in>
                        @include('partials/image', ['image' => get_field('culture_image')])
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile; ?>
@endsection