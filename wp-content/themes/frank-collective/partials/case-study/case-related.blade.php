<div class="case-related">
    <div class="container">
        <div class="back">
            <a href="/work/"><i class="icon-left-arrow"></i>Back to Work</a>
        </div>
        @if(get_field('next_case_study') || get_field('prev_case_study') )
            <div class="grid-flex"  data-appear-block>
                @if(get_field('prev_case_study'))
                <div class="col-sm-6 case-col">
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
                        <a href="{{ get_permalink() }}" class="case-card ajax-load" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}" data-transition-out="related_case_out">
                            <div class="bg-img" style='background-image: url({{ helper::imageURL(get_field('main_image'), 'full') }});'></div>
                            @if(get_field('brand_name'))
                                <h2></h2>
                            @endif
                            <div class="body">
                                <span class="subtitle">{{ get_field('brand_name') }}</span>
                                <h3>{{ get_field('tagline') }}</h3>
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
                    <div class="col-sm-6 case-col">
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
                            <a href="{{ get_permalink() }}" class="case-card ajax-load" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}" data-transition-out="related_case_out">
                                <div class="bg-img" style='background-image: url({{ helper::imageURL(get_field('main_image'), 'full') }});'></div>
                                @if(get_field('brand_name'))
                                    <h2></h2>
                                @endif
                                <div class="body">
                                    <span class="subtitle">{{ get_field('brand_name') }}</span>
                                    <h3>{{ get_field('tagline') }}</h3>
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