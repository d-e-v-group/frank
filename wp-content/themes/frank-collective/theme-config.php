<?php

namespace BaseTheme;

/**
* Loads the base theme class.  The base_theme_class is extended here.
* Please see wiki documentation for full set of features and helpers available in the base_theme_class.
*/
include_once( 'core/base-theme-class.php' );  

class Theme extends base_theme_class {


    /*
    
    Allows you to disable WordPress from including jQuery by default.

    You should only set this to value if your theme.js file includes jQuery.

    */
    var $include_jquery = true;


    /*
    
    Loads an options panel in wp-admin.
    If this is enabled, you create custom fields and target them to this option panel.

    */
    var $load_options_panel = true;


    /*

    if you want to force disable to WP theme editor, set this to true.
    Since we keep our WP themes in version control, we set this to true by default.

    */
    var $disabled_theme_editor = true;


    /*

    toggle featured image support on your posts and pages

    */
    var $load_thumbnail_support = true;


    /*

    this allows you to edit the default text that appears with post excerpts.
    If you set this to null, a simple "..." will output at the end of each excerpt.

    */
    var $excerpt_text = 'Read More';


    /*

    by default, the theme will disable the ACF Options menu in wp-admin, unless WP_DEBUG is set to true.
    If you want to force enable to ACF options panel to display, you can set this variable as true
    
    */
    var $force_enable_acf_option_panel = true;


    public function __construct()
    {

        parent::__construct(); 

        $this->theme_name = defined('THEME_NAME') ? THEME_NAME : 'base-theme';
        $this->version = getenv('VERSION') ? getenv('VERSION') : '1.0.8';

    }


    /*
    
    Load Custom Post Types
    Extended CPTs https://github.com/johnbillion/extended-cpts/wiki
    
    */
    public function load_custom_post_types()
    {
        /*
        // Sample Custom Post Type - Add as many as you'd like 
        register_extended_post_type( 'story', array(

            # Add the post type to the site's main RSS feed:
            'show_in_feed' => true,

            # Show all posts on the post type archive:
            'archive' => array(
                'nopaging' => true
            ),

            # Add some custom columns to the admin screen:
            'admin_cols' => array(
                'featured_image' => array(
                    'title'          => 'Illustration',
                    'featured_image' => 'thumbnail'
                ),
                'published' => array(
                    'title'       => 'Published',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y'
                ),
                'genre' => array(
                    'taxonomy' => 'genre'
                )
            ),

            # Add a dropdown filter to the admin screen:
            'admin_filters' => array(
                'genre' => array(
                    'taxonomy' => 'genre'
                )
            )

        ), array(

            # Override the base names used for labels:
            'singular' => 'Story',
            'plural'   => 'Stories',
            'slug'     => 'stories'

        ) );
        */
	    register_extended_post_type( 'work', array(

		    # Add the post type to the site's main RSS feed:
		    'show_in_feed' => true,
		    'has_archive' => false,
		    'admin_cols' => array(
			    'industry' => array(
				    'taxonomy' => 'industry'
			    ),
			    'service' => array(
				    'taxonomy' => 'service'
			    )
		    ),

	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Work',
		    'plural'   => 'Works',
		    'slug'     => 'work'

	    ) );

	    register_extended_post_type( 'press', array(

		    # Add the post type to the site's main RSS feed:
		    'show_in_feed' => true,
		    'admin_cols' => false,
            'has_archive' => false,
            'archive' => false
	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Press',
		    'plural'   => 'Press',
		    'slug'     => 'press'

	    ) );

	    register_extended_post_type( 'team', array(

		    # Add the post type to the site's main RSS feed:
		    'show_in_feed' => true,
		    'archive' => false,
		    'admin_cols' => false,
		    'has_archive' => false
	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Team',
		    'plural'   => 'Team',
		    'slug'     => 'team'

	    ) );

	    register_extended_post_type( 'career', array(

		    # Add the post type to the site's main RSS feed:
		    'show_in_feed' => true,
		    'archive' => false,
		    'admin_cols' => false,
		    'has_archive' => false
	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Career',
		    'plural'   => 'Careers',
		    'slug'     => 'career'

	    ) );

    }

    /*
    
    Load Custom Taxonomies
    Extended Taxos https://github.com/johnbillion/extended-taxos
    
    */
    public function load_custom_taxonomies()
    {

	    register_extended_taxonomy( 'city', 'career', array(

		    # Show this taxonomy in the 'At a Glance' dashboard widget:
		    'dashboard_glance' => false,
		    'meta_box' => 'radio',
		    # Add a custom column to the admin screen:
		    'admin_cols' => [],

	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'City',
		    'plural'   => 'Cities',
		    'slug'     => 'careers/cities'

	    ) );

	    register_extended_taxonomy( 'industry', 'work', array(

		    # Show this taxonomy in the 'At a Glance' dashboard widget:
		    'dashboard_glance' => false,

		    # Add a custom column to the admin screen:
		    'admin_cols' => [],

	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Industry',
		    'plural'   => 'Industries',
		    'slug'     => 'work/industries'

	    ) );

	    register_extended_taxonomy( 'service', 'work', array(

		    # Show this taxonomy in the 'At a Glance' dashboard widget:
		    'dashboard_glance' => false,

		    # Add a custom column to the admin screen:
		    'admin_cols' => [],

	    ), array(

		    # Override the base names used for labels:
		    'singular' => 'Service',
		    'plural'   => 'Services',
		    'slug'     => 'work/services'

	    ) );

        // Sample Custom Taxonomy - Add as many as you'd like 

        /*

        register_extended_taxonomy( 'story', 'post', array(

            # Use radio buttons in the meta box for this taxonomy on the post editing screen:
            'meta_box' => 'radio',

            # Show this taxonomy in the 'At a Glance' dashboard widget:
            'dashboard_glance' => true,

            # Add a custom column to the admin screen:
            'admin_cols' => array(
            'updated' => array(
                'title'       => 'Updated',
                'meta_key'    => 'updated_date',
                'date_format' => 'd/m/Y'
            ),
            ),

            ), array(

            # Override the base names used for labels:
            'singular' => 'Story',
            'plural'   => 'Stories',
            'slug'     => 'tales'

        ) );

        */

    }

    public function load_shortcodes()
    {

        //This is a sample shortcode.  Please see full shortcode documentation. 
        
        /* */

        /*add_shortcode( 'contact_form', function($atts) {

            return view('forms/contact-form')->with(array(

                'form_title' => 'Contact Us',
                'atts' => $atts

            ));

        });*/

    }



    public function load_sidebars()
    {

        /*register_sidebar(array(
            'name'          => 'Primary',
            'id'            => 'sidebar-primary',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ));*/

        
    }

    public function load_options_panel()
    {

        acf_add_options_page(array(
            'page_title'    => 'Theme Options',
            'menu_title'    => 'Options',
            'menu_slug'     => 'theme-options-settings',
            'capability'    => 'edit_posts',
            'redirect'      => true
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'Header & Footer Options',
            'menu_title'    => 'Header / Footer',
            'parent_slug'   => 'theme-options-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'JavaScript & CSS Options',
            'menu_title'    => 'Javascript / CSS',
            'parent_slug'   => 'theme-options-settings',
        ));

	    acf_add_options_sub_page(array(
		    'page_title'    => 'Style Options',
		    'menu_title'    => 'Style Options',
		    'parent_slug'   => 'theme-options-settings',
	    ));

	    acf_add_options_sub_page(array(
		    'page_title'    => 'Call To Action Options',
		    'menu_title'    => 'Call To Action',
		    'parent_slug'   => 'theme-options-settings',
	    ));

    }

    public function set_menus()
    {

        $this->menus = array(
            'main_nav' => 'Main Navigation', 
            'footer_nav' => 'Footer Navigation',
            'footer_links' => 'Footer Small Links'
        );
        
    }

    /**
    * Set the image size array.
    *
    * $image_sizes[] = array('name' => 'image-size-name', 'width' => 600, 'height' => 400, 'crop' => true)  
    * set width/height to 9999 to not force that size.
    * set crop to false to not force the size.
    */
    public function set_image_sizes()
    {

        $this->image_sizes[] = array(
            'name' => 'medium-size',
            'width' => 600,
            'height' => 400,
            'crop' =>true
        );

	    $this->image_sizes[] = array(
		    'name' => 'team-photo',
		    'width' => 620,
		    'height' => 820,
		    'crop' =>true
	    );
    }

}

$theme = new \BaseTheme\Theme;

