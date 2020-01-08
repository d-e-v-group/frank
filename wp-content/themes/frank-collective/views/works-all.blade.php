@layout('layouts/master')
<?php /* Template Name: Work All */ ?>
@section('content')

	<?php while ( have_posts() ) : the_post(); ?>
    <div class="root barba-container" data-namespace="archive" data-page-id="Archive" data-transition-in="archive_in" data-transition-out="archive_out" data-page-init="archive_init">
        <div class="main default-content">
            <div class="container">
                <div class="media-container" data-filter-work>
                    <div class="top-row">
                        <strong class="filter">
                            Filter by <a href="#" class="link-u" data-filter-work-select>All</a>
                            <a href="#" class="close"></a>
                        </strong>
                    </div>
                    <div class="filter-drop filter-drop-hidden" style="display: none" data-filter-work-drop>
                        <div class="grid">
                            @if(!empty(get_terms('industry')))
                                <div class="col-xs-6 col" data-filter-type="industry">
                                    <h5>Industry</h5>
                                    <ul class="filter-list">
                                    @foreach(get_terms('industry') as $term)
                                        <li><a href="#" data-filter-type="industry" data-filter-val="{{$term->slug }}">{{ $term->name }}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(!empty(get_terms('service')))
                                <div class="col-xs-6 col" data-filter-type="service">
                                    <h5>Service</h5>
                                    <ul class="filter-list">
                                        @foreach(get_terms('service') as $term)
                                            <li><a href="#" data-filter-type="service" data-filter-val="{{$term->slug }}">{{ $term->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <?php
                    $args = array(
                        'post_type' => ['work'],
                        'post_status' => ['publish'],
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'posts_per_page' => 20,
                        'has_password' => false,
                    );
                    $postIndex = 0;
                    $query_works = new WP_Query( $args );
                    ?>
                    @if($query_works->have_posts())
                        <div class="media-group works-all" data-load-more-list="work" data-filter-works-list>
                            <?php
                            while ( $query_works->have_posts() ) : $query_works->the_post();
                            ?>
                            <div class="col-sm-4">
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
                                            <div class="grid-flex">
                                                <div class="col-sm-12 title-col">
                                                    <h4>{{ get_field('brand_name') }}</h4   >
                                                </div>
                                                <?php
                                                $term_obj_list = get_the_terms( get_the_ID(), 'service' );
                                                ?>
                                                @if(!empty($term_obj_list))
                                                    <?php
                                                    $services = array_chunk($term_obj_list, 3);
                                                    ?>
                                                    <div class="col-sm-12">
                                                        @if(get_field('tagline') || get_field('tagline_short'))
                                                            <h5>{{ (get_field('tagline_short')) ? get_field('tagline_short') : get_field('tagline') }}</h5>
                                                        @endif
                                                        <ul class="service-list">
                                                            @foreach($term_obj_list as $item)
                                                                <li>{{ $item->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                    </div>
                                                @endif
                                            </div>
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
                                <a href="#" class="link-more" data-load-more="work">View More Work</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials/cta/contact')
    </div>
	<?php endwhile; ?>
@endsection