@layout('layouts/master')
<?php /* Template Name: Press */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="articles" data-page-id="Articles" data-transition-in="articles_in" data-transition-out="articles_out" data-page-init="articles_init">
    <div class="main default-content">
        <div class="container">
            <div class="media-container press-content">
                <div class="top-row">
                    <div data-appear-text>
                        <h1>Press</h1>
                    </div>
                    <strong class="filter" data-appear-text>Filter by <a href="#" class="link-u">All</a></strong>
                </div>
                <?php
                $currentPageNumber = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
                $args = [
                    'post_type' => ['press'],
                    'post_status' => ['publish'],
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 4,
                    'paged' => $currentPageNumber
                ];

                $query_articles = new WP_Query( $args );
                ?>
                @if($query_articles->have_posts())
                <div class="media-group append-posts-from-load-more" data-load-more-list="press" data-appear-block>
                    <?php
                    while ( $query_articles->have_posts() ) : $query_articles->the_post();
                    ?>
                    <div class="media grid-flex">
                        <div class="col-sm-3">
                            <div class="box gray">
                                <div class="logo-wrap">
                                    @include('partials/image', ['image' => get_field('logo')])
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="text-content">
                                <div class="frame">
                                    <h5>{{ get_field('date') }}</h5>
                                    <h4 class="title">{{ get_the_title() }}</h4>
                                    <a href="{{ get_permalink() }}" class="link-u">Read Article</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                @endif

                @if($query_articles->max_num_pages > $currentPageNumber)
                <div class="full-btn">
                    <div class="grid">
                        <div
                            data-appear-text
                            data-target=".append-posts-from-load-more .media"
                            data-append-to=".append-posts-from-load-more"
                            data-load-more=".btn-load-more-ajax a"
                            class="col-sm-6 col-sm-offset-3 btn-load-more-ajax">
                            <a href="{{ get_permalink() }}?pageNumber={{ $currentPageNumber + 1 }}" class="btn btn-secondary" data-load-more="press">Load More</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile; ?>
@endsection