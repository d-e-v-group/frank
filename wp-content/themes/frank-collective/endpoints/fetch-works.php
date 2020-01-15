<?php
/**
* AJAX Endpoint for contact form.
* Post to admin-ajax.php with the action param as "contact_form"
* This can be used as a sample to create other AJAX endpoints in the theme.
* Add as many of these files in the /endpoints/ directory and they will automatically be loaded into your WP site.
*/
$action_param = 'fetch_works';

add_action( 'wp_ajax_' . $action_param, 'custom_fetch_works' );
add_action( 'wp_ajax_nopriv_' . $action_param, 'custom_fetch_works' );

function custom_fetch_works()
{   
    $page = 1;
    $post_per_page = 10;

	if( $_REQUEST['industry'] ) {
		$industry_terms = array();
		foreach( $_REQUEST['industry'] as $term ) {
			$industry_terms[] = $term;
		}
	}

	if( $_REQUEST['services'] ) {
		$service_terms = array();
		foreach( $_REQUEST['services'] as $term ) {
			$service_terms[] = $term;
		}
	}

    $tax_query = array();

    if($_REQUEST['page'] && !empty($_REQUEST['page'])){
        $page = $_REQUEST['page'];
    }

    if($_REQUEST['industry'] && !empty($_REQUEST['industry'])){
        $tax_query[] = array(
            'taxonomy' => 'industry',
            'field' => 'slug',
            'terms' => $industry_terms,
        );
    }
    if($_REQUEST['services'] && !empty($_REQUEST['services'])){
        $tax_query[] = array(
            'taxonomy' => 'service',
            'field' => 'slug',
            'terms' => $service_terms,
        );
    }
	
    $args = array(
        'post_type' => ['work'],
        'post_status' => ['publish'],
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'has_password' => false,
        'posts_per_page' => 20 + $post_per_page * ($page - 1),
    );

    if(!empty($tax_query)){
        $tax_query['relation'] = 'AND';
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    $loadMore = $query->found_posts > $query->post_count;
    $page = '';
    
    if($query){
        $posts = $query->posts;
        if($posts){
            foreach($posts as $key => $post) {
                $page .= '<div class="col-sm-4">';
                $page .= '<div data-link="'. get_permalink($post->ID) .'" class="media grid-flex work-item ajax-load is-appeared" data-appear-block>';
	            $page .= '<div class="col-sm-12">';

                $image = get_field('thumbnail_image', $post->ID) ? get_field('thumbnail_image', $post->ID) : get_field('main_image', $post->ID);
                $case_image = get_field('hero_section_image', $post->ID) ? get_field('hero_section_image', $post->ID) : get_field('main_image', $post->ID);

                $page .= '<div class="img-box" data-image="'. wp_get_attachment_image_src($case_image, 'full')[0].'">';
                $page .= '<div class="inner-content" style="background-image:url('.wp_get_attachment_image_src($image, 'full')[0].')"></div>';
                $page .= '</div>';
                $page .= '</div>';
                $page .= '<div class="col-sm-12">';
                $page .= '<div class="text-content">';
                $page .= '<div class="grid-flex">';
                $page .= '<div class="col-sm-12 title-col">';
                $page .= '<h4>'. get_field('brand_name', $post->ID) .'</h4>';
                $page .= '</div>';
                $term_obj_list = get_the_terms( $post->ID, 'service' );
                if(!empty($term_obj_list)){
                    $services = array_chunk($term_obj_list, 3);
                    $page .= '<div class="col-sm-12">';
                    $page .= '<h5>'. get_field('tagline_short', $post->ID) .'</h5>';
                    /*
                    $page .= '<ul class="service-list">';
                    foreach($term_obj_list as $item){
                        $page .= '<li>'. $item->name .'</li>';
                    }
                    $page .= '</ul>';
                    */
                    $page .= '</div>';
                }
                $page .= '</div>';
                $page .= '</div>';
                $page .= '</div>';
                $page .= '</div>';
                $page .= '</div>';
            }
        }
    }
    wp_reset_postdata();

    return ! is_wp_error($query)
        ? wp_send_json(array('status' => 'success', 'works' => $page, 'industry' => $industry_terms, 'service' => $service_terms, 'loadMore' => $loadMore))
        : wp_send_json(array('status' => 'error', 'message' => $query->get_error_message()));
 

}