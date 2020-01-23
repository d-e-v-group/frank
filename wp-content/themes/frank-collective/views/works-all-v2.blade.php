@layout('layouts/master')
<?php /* Template Name: Work All v2 */ ?>
@section('content')

    <?php while ( have_posts() ) : the_post(); ?>
    <div id="all-work-v2" class="root barba-container" data-namespace="archive" data-page-id="Archive" data-transition-in="archive_in" data-transition-out="archive_out" data-page-init="archive_init">

            <div class="media-container" data-filter-work>
                <section id="work-filter-section" data-nav-dark data-dark>

                <div class="container filter-drop" data-filter-work-drop>
                    <div class="grid">
                        <div class="row filter-toggles">
                            <h5 class="col-xs-5 col-md-3 col-lg-3 col filter-drop-service">Service</h5>
                            <h5 class="col-xs-5 col-md-3 col-lg-8 col filter-drop-industry">Industry</h5>
                            <div class="col-xs-2 col-lg-1 col clear-filters" style="display:none;"><span>Clear Filters</span></div>
                        </div>
                        @if(!empty(get_terms('service')))
                        <div class="row filter-wrap-service">
                            <div class="col-xs-12 col-lg-9 filter-list-service" style="display:none;" data-filter-type="service">
                                <ul class="filter-list">
                                    @foreach(get_terms('service') as $term)
                                        <li><a href="#" data-filter-type="service" data-filter-val="{{$term->slug }}">{{ $term->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif 
                        @if(!empty(get_terms('industry')))
                        <div class="row filter-wrap-industry">
                            <div class="col-xs-12 col-lg-9 col-lg-offset-3 col filter-list-industry" style="display:none;" data-filter-type="industry">
                                <ul class="filter-list">
                                @foreach(get_terms('industry') as $term)
                                    <li><a href="#" data-filter-type="industry" data-filter-val="{{$term->slug }}">{{ $term->name }}</a></li>
                                @endforeach                            
                                </ul>
                            </div>
                        </div> 
                        @endif                           
                    </div>
                </div>


    
                </section>
                <section id="work-display">
                    <div class="work-list featured-work container">
                        <?php
                        $options = array(
                            'post_type' => 'work',
                            'orderby' => 'post__in',
                            'post__in' => get_field('works', 8931),
                            'posts_per_page'	=> 10,
                        );
                        $work_idx = 0;
                        $team = new WP_Query( $options );
                        while( $team->have_posts() ) : $team->the_post();
                        ?>
                    <div class="work-wrap col-md-6">
                        <div class="work-item ajax-load position-{{ ($work_idx % 2 === 0) ? 'left' : 'right' }}" data-link="{{ get_permalink() }}" data-background-color="{{ (get_field('theme_color')) ? get_field('theme_color') : '#ffffff' }}">
                            <div class="work view-case-study" data-position="{{ ($work_idx % 2 === 0) ? 'left' : 'right' }}" data-link="{{ get_permalink() }}" data-appear-block data-appear-offset="0.2">
                            <?php $image = get_field('thumbnail_image') ? get_field('thumbnail_image') : get_field('main_image') ?>
                            <?php $case_image = get_field('hero_section_image') ? get_field('hero_section_image') : get_field('main_image') ?>
                            <div class="img-box inner-content" data-image="{{ helper::imageURL($case_image, 'full') }}">
                            
                                @if(get_field('main_image') || get_field('hero_section_image') || get_field('featured_project_video'))
                                    @if(get_field('featured_project_video'))
                                        <div class="featured-project work-video-wrap ajax-preload-assets">
                                            <video autoplay muted loop playsinline class="work-video">
                                                <source src="{{ get_field('featured_project_video') }}" type="video/mp4">
                                            </video>
                                        </div>
                                    @else
                                        <div class="featured-project img" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}">
                                            <div class="bg-img" style='background-image: url({{ helper::imageURL(get_field("main_image"), "full") }});'></div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="desc">
                                <h5 class="work-cat">{{ get_field('brand_name') }}</h5>
                                @if(get_field('tagline') || get_field('tagline_short'))
                                    <h5 class="tagline">{{ (get_field('tagline_short')) ? get_field('tagline_short') : get_field('tagline') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $work_idx++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

                <!-- ALL WORKS -->
                <?php
                $args = array(
                    'post_type' => ['work'],
                    'post_status' => ['publish'],
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'posts_per_page' => 21,
                    'has_password' => false,
                );
                $postIndex = 0;
                $query_works = new WP_Query( $args );
                ?>
                @if($query_works->have_posts())

                

                    <div class=" works-all container" data-filter-works-list>
                        <?php
                        while ( $query_works->have_posts() ) : $query_works->the_post();
                        ?>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <div data-link="{{ get_permalink() }}" class="media grid-flex work-item ajax-load" data-appear-block data-row-index="{{ $postIndex }}">
                                    
                                    <div class="col-sm-12">
                                        <?php $image = get_field('thumbnail_image') ? get_field('thumbnail_image') : get_field('main_image') ?>
                                        <?php $case_image = get_field('hero_section_image') ? get_field('hero_section_image') : get_field('main_image') ?>
                                        <div class="img-box" data-image="{{ helper::imageURL($case_image, 'full') }}">
                                            {{ helper::imageDiv($image, 'full', ['class' => 'inner-content']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="text-content">
                                            <h4>{{ get_field('brand_name') }}</h4>
                                            @if(get_field('tagline') || get_field('tagline_short'))
                                                <h5 class="tagline">{{ (get_field('tagline_short')) ? get_field('tagline_short') : get_field('tagline') }}</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $postIndex ++ ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                @endif
                <div class="full-btn" data-loadmore-works>
                    <div class="grid">
                        <div class="col-sm-6 col-sm-offset-3" data-appear-text>
                            <a href="#" id="load-more-work" class="link-more" data-load-more="work"></a>
                        </div>
                    </div>
                </div>
            </section>    
            </div>

                <div id="scrollToTop">
                    <div class="container">
                        <a>Back to Top</a>
                    </div>
                </div> 
            </div>
            @include('partials/cta/contact')

        </div>  
	<?php endwhile; ?>
@endsection
