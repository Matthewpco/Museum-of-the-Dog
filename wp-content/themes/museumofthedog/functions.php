<?php
// Check if the memory limit is defined and set it to a higher value for better performance.
if (!defined('WP_MEMORY_LIMIT')) {
    define('WP_MEMORY_LIMIT', '256M');
}


// Check if the maximum execution time is defined and set it to a higher value for better performance.
if (!defined('WP_MAX_EXECUTION_TIME')) {
    define('WP_MAX_EXECUTION_TIME', 300);
}


function motd_enqueue_parent_styles() {
    // This is the parent theme's stylesheet handle.
    $parent_style = 'parent-style';

    // Dequeue the parent theme's stylesheet if desired.
    if (apply_filters('my_theme_dequeue_parent_style', false)) {
        wp_dequeue_style($parent_style);
    } else {
        // Enqueue the parent theme's stylesheet.
        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    }
}
add_action('wp_enqueue_scripts', 'motd_enqueue_parent_styles');


function motd_enqueue_child_styles() {
    // This is the child theme's stylesheet handle.
    $child_style = 'child-style';

    // Get the child theme's stylesheet file path.
    $child_stylesheet_path = get_stylesheet_directory() . '/style.css';

    // Enqueue the child theme's stylesheet with filemtime for cache busting.
    wp_enqueue_style($child_style, get_stylesheet_uri(), array('parent-style'), filemtime($child_stylesheet_path));
}
add_action('wp_enqueue_scripts', 'motd_enqueue_child_styles');


function motd_enqueue_scripts() {
  wp_enqueue_script( 'image-scroll', get_stylesheet_directory_uri() . '/js/featured-image-title.js', array(), '1.0.0', true );
  wp_enqueue_script( 'mobile-nav', get_stylesheet_directory_uri() . '/js/mobile-nav-menu.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'motd_enqueue_scripts' );


function motd_enqueue_font_awesome_styles() {
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/font-awesome/all.css', array(), '6.4.0' );
}
add_action( 'wp_enqueue_scripts', 'motd_enqueue_font_awesome_styles' );


// Remove the WordPress version number from the head and RSS feeds for security.
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');


// Disable XML-RPC for security.
add_filter('xmlrpc_enabled', '__return_false');


// remove page title from front end
function my_remove_page_title( $title ) {
    if ( is_page() ) {
        return '';
    }
    return $title;
}


//add_filter( 'the_title', 'my_remove_page_title' );
function mobile_nav_menu_shortcode() {
    ob_start();
    get_template_part('template-parts/mobile-nav-header');
    get_template_part('template-parts/mobile-nav-menu');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('mobile_nav_menu', 'mobile_nav_menu_shortcode');

//add artworks custom post type
function create_artworks_post_type() {
    register_post_type('artworks',
        array(
            'labels' => array(
                'name' => __('Artworks'),
                'singular_name' => __('Artwork')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'create_artworks_post_type');


// Send various headers for better security
function add_security_headers() {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header("Referrer-Policy: no-referrer-when-downgrade");
}
add_action('send_headers', 'add_security_headers');