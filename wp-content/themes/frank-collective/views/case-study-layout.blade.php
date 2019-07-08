@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study */ ?>
@section('content')
<?php

    $current_section_id = 0;
    $nav_sections = [];

    if(get_field('banner_in_top_menu') && get_field('banner_menu_label')){
	    $nav_sections[] = get_field('banner_menu_label');
	    $current_section_id ++;
    }

    if(!empty(get_field('flexible_content_sections'))){
        foreach(get_field('flexible_content_sections') as $section){
        	if($section['in_top_menu'] && $section['menu_label']){
		        $nav_sections[] = $section['menu_label'];
            }
        }
    }

    $nav = [
    	'title' => get_field('brand_name'),
        'sections' => $nav_sections
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    @if(get_field('main_image') || get_field('hero_section_image') || get_field('hero_section_video'))
        @if(get_field('hero_section_video'))
            <div class="case-hero-banner video-banner"
                 @if(get_field('banner_in_top_menu') && get_field('banner_menu_label'))
                 id="section-0" data-nav-section="section-0"
                 @endif
                 @if(get_field('main_banner_navigation_color') === 'light')
                 data-dark
                @endif
            >
                <div class="video-wrap">
                    <video autoplay muted loop playsinline class="video ajax-preload-assets">
                        <source src="{{ get_field('hero_section_video') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        @else
			<?php $image = get_field('hero_section_image') ? get_field('hero_section_image') : get_field('main_image'); ?>
            <div class="case-hero-banner" style="background-image: url('{{ helper::imageURL($image, 'full') }}');" data-ajax-preload-assets="{{ helper::imageURL($image, 'full') }}"
                @if(get_field('banner_in_top_menu') && get_field('banner_menu_label'))
                 id="section-0" data-nav-section="section-0"
                @endif
                @if(get_field('main_banner_navigation_color') === 'light')
                 data-dark
                @endif
            ></div>
        @endif
    @endif

    @if(!empty(get_field('flexible_content_sections')))
        @foreach(get_field('flexible_content_sections') as $section)
            <?php
			$section_id = false;
			if($section['in_top_menu'] && $section['menu_label']) {
				$section_id = 'section-'.$current_section_id;
				$current_section_id ++;
			}
			?>
            @include('components/case-study/' . $section['acf_fc_layout'], ['section_id' => $section_id])
        @endforeach
    @endif
    @if(!get_field('disable_contact_us_section'))
        @include('partials/cta/contact')
    @endif
    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection