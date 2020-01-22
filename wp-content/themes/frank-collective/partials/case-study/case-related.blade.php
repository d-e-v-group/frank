<div class="case-related">
    <div class="container">
        <div class="back">
            <a href="/all-work-v2/"><i class="icon-left-arrow"></i>Back to Work</a>
        </div>
        @if(get_field('next_case_study') || get_field('prev_case_study') )
            <div class="grid-flex"  data-appear-block>
                @if(get_field('prev_case_study'))
                <div class="work-wrap col-xs-6 col-md-6 case-col">
                    <div class="cta case-cta">
	                    <?php
	                    $options = array(
		                    'post_type' => 'work',
		                    'orderby' => 'post__in',
		                    'post__in' => [get_field('prev_case_study')]
	                    );
	                    $team = new WP_Query( $options );
	                    while( $team->have_posts() ) : $team->the_post();
	                    ?>
                        <a href="{{ get_permalink() }}" class="case-card ajax-load"  data-transition-out="related_case_out">
                            <div class="bg-img img-box" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}">
                                {{ helper::imageDiv(get_field('main_image'), 'full', ['class' => 'inner-content']) }}
                            </div>
                            <div class="desc">
                                <h5 class="work-cat">{{ get_field('brand_name') }}</h5>
                                <h5>{{ get_field('tagline') }}</h5>
                            </div>
                        </a>
	                    <?php
	                    endwhile;
	                    wp_reset_postdata();
	                    ?>
                    </div>
                </div>
                @endif

                @if(get_field('next_case_study'))
                    <div class="work-wrap col-xs-6 col-md-6">
                        <div class="cta case-cta">
                            <?php
                            $options = array(
                                'post_type' => 'work',
                                'orderby' => 'post__in',
                                'post__in' => [get_field('next_case_study')]
                            );
                            $team = new WP_Query( $options );
                            while( $team->have_posts() ) : $team->the_post();
                            ?>
                            <a href="{{ get_permalink() }}" class="case-card ajax-load"  data-transition-out="related_case_out">
                                <div class="bg-img img-box" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}">
                                    {{ helper::imageDiv(get_field('main_image'), 'full', ['class' => 'inner-content']) }}
                                </div>
                                <div class="desc">
                                    <h5 class="work-cat">{{ get_field('brand_name') }}</h5>
                                    <h5>{{ get_field('tagline') }}</h5>
                                </div>
                            </a>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>