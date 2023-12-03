<?php
/**
 * EsbjergMuseum functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EsbjergMuseum
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function esbjergmuseum_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on EsbjergMuseum, use a find and replace
		* to change 'esbjergmuseum' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'esbjergmuseum', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'esbjergmuseum' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'esbjergmuseum_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'esbjergmuseum_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function esbjergmuseum_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'esbjergmuseum_content_width', 640 );
}
add_action( 'after_setup_theme', 'esbjergmuseum_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function esbjergmuseum_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'esbjergmuseum' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'esbjergmuseum' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'esbjergmuseum_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function esbjergmuseum_scripts() {
	wp_enqueue_style( 'esbjergmuseum-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'esbjergmuseum-main', get_template_directory_uri() . '/css/main.css');
	wp_style_add_data( 'esbjergmuseum-style', 'rtl', 'replace' );

	wp_enqueue_script( 'esbjergmuseum-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'esbjergmuseum_scripts' );


/**
 * Implement the Custom fonts.
 */
function enqueue_custom_fonts(){
	if(!is_admin()){
		wp_register_style('Montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,500&display=swap');
		wp_register_style('Hind', 'href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap');
		wp_enqueue_style('Montserrat');
		wp_enqueue_style('Hind');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function ad_remove_gutenberg(){
    remove_post_type_support( "page", "editor" );
    remove_post_type_support( "post", "editor" );

}

add_action( "init", "ad_remove_gutenberg");



function enqueue_slick_scripts() {
    // Add Slick Carousel CSS
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');

    // Add Slick Carousel JS
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_slick_scripts');

// functions.php

// Register Custom Post Type
function create_slider_post_type() {
    register_post_type('slider_item',
        array(
            'labels' => array(
                'name' => __('Slider Items'),
                'singular_name' => __('Slider Item'),
            ),
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-images-alt2',
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}

add_action('init', 'create_slider_post_type');




// Add ACF fields for slider item
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_5f9042a2eae4f',
        'title' => 'Slider Item Fields',
        'fields' => array(
            array(
                'key' => 'field_5f9042ac29c74',
                'label' => 'Image',
                'name' => 'slider_image',
                'type' => 'image',
                'instructions' => 'Upload the image for the slider item.',
                'required' => 1,
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array(
                'key' => 'field_5f9042c429c75',
                'label' => 'Title',
                'name' => 'slider_title',
                'type' => 'text',
                'instructions' => 'Enter the title for the slider item.',
                'required' => 1,
            ),
            array(
                'key' => 'field_5f9042d829c76',
                'label' => 'Description',
                'name' => 'slider_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description for the slider item.',
                'required' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'slider_item',
                ),
            ),
        ),
        'position' => 'normal',
    ));
}
function register_slider_item_post_type() {
    register_post_type('slider_item', array(
        'labels' => array(
            'name' => __('Slider Items'),
            'singular_name' => __('Slider Item'),
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
    ));
}

add_action('init', 'register_slider_item_post_type');


function enqueue_bootstrap() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css');

    // Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

function plp_register_strings() {

    pll_register_string("Polylang", "Information");
    pll_register_string("Polylang", "Map");
    pll_register_string("Polylang", "Access");
    pll_register_string("Polylang", "AccessText");
    pll_register_string("Polylang", "valg");
    pll_register_string("Polylang", "Kontakt");
    pll_register_string("Polylang", "Kontaktoplysninger");
    pll_register_string("Polylang", "Kontaktoplysningerinfo");
    pll_register_string("Polylang", "hverdag");
    pll_register_string("Polylang", "weekend");
    pll_register_string("Polylang", "telehver");
    pll_register_string("Polylang", "teleweek");
    pll_register_string("Polylang", "mailhver");
    pll_register_string("Polylang", "mailweek");


    // Register strings from template-events.php
    $event_args = array(
        'post_type' => 'event',
    );

    $event_query = new WP_Query($event_args);

    if ($event_query->have_posts()) {
        while ($event_query->have_posts()) {
            $event_query->the_post();

            $event_header_text = get_field('event_header_text');
            pll_register_string("Polylang", $event_header_text, 'Event Header Text');

            $event_description = get_field('event_description');
            pll_register_string("Polylang", $event_description, 'Event Description');

            $event_date = get_field('event_date');
            pll_register_string("Polylang", $event_date, 'Event Date');
            
        }

        wp_reset_postdata();
    }

    // Register strings from template-slider.php
    $slider_args = array(
        'post_type' => 'slider_item',
        'posts_per_page' => -1,
    );

    $slider_query = new WP_Query($slider_args);

    if ($slider_query->have_posts()) {
        while ($slider_query->have_posts()) {
            $slider_query->the_post();

            $slider_title = get_field('slider_title');
            pll_register_string("Polylang", $slider_title, 'Slider Title');

            $slider_description = get_field('slider_description');
            pll_register_string("Polylang", $slider_description, 'Slider Description');
        }

        wp_reset_postdata();
    }

	 // Register strings for custom cards
	 $card_args = array(
        'post_type' => 'custom-cards',
        'posts_per_page' => -1,
    );

    $card_query = new WP_Query($card_args);

    if ($card_query->have_posts()) {
        while ($card_query->have_posts()) {
            $card_query->the_post();

            $card_title = pll__(get_field('card-title'));
            pll_register_string("Polylang", $card_title, 'Card Title');

            $card_subtitle = pll__(get_field('card-subtitle'));
            pll_register_string("Polylang", $card_subtitle, 'Card Subtitle');

            $card_description = pll__(get_field('card-text'));
            pll_register_string("Polylang", $card_description, 'Card Description');

            $card_price = pll__(get_field('price'));
            pll_register_string("Polylang", $card_price, 'Card Price');

            $card_info = pll__(get_field('info'));
            pll_register_string("Polylang", $card_info, 'Card Info');
        }

        wp_reset_postdata();
    }
	
}

add_action("init", "plp_register_strings");


function polylang_flags_shortcode() {
    ob_start();
    pll_the_languages(array('show_flags'=>1,'show_names'=>0));
    $flags = ob_get_clean();
    return '<ul class="polylang-flags">' . $flags . '</ul>';
}
add_shortcode('POLYLANG', 'polylang_flags_shortcode');