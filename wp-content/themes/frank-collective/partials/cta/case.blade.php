<div class="cta-row">
    <div class="container">
        <div class="grid-flex">
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
                        <a href="{{ get_permalink() }}" data-image="{{ helper::imageURL(get_field('main_image'), 'full') }}">
                            <div class="bg-img" style='background-image: url({{ helper::imageURL(get_field('main_image'), 'full') }});'></div>
                            @if(get_field('brand_name'))
                            <h2>{{ get_field('brand_name') }}</h2>
                            @endif
                            <p><span class="link-u">View Case Study</span></p>
                        </a>
	                <?php
	                endwhile;
	                wp_reset_postdata();
	                ?>
                </div>
            </div>
            @endif
            <div class="col-sm-{{ get_field('next_case_study') ? '6' : '12' }}">
                <?php
                    $button = get_field('cta_contacts_button', 'options');
	                $link = $button['type'] == 'internal'
		                ? $button['internal_link']
		                : $button['external_link'];
                ?>
                <a class="cta contact-cta" href="{{ $link }}">
                    @if(get_field('cta_contacts_title', 'options'))
                        <h2>{{ get_field('cta_contacts_title', 'options') }}</h2>
                    @endif
                    @if(get_field('cta_contacts_button', 'options'))
                        <p>
                            <span class="link-u">{{ $button['label'] }}</span>
                        </p>
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>