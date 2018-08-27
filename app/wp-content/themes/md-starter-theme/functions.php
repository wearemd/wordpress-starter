<?php

// Include autoload from Composer
include __DIR__ . '/vendor/autoload.php';

// Load WYSIWYG sanitization
include __DIR__ . '/lib/sanitize-wysiwyg.php';

$timber = new Timber\Timber();

// Declare templates location
Timber::$dirname = array(
    'templates'
);

// Load assets
add_action( 'wp_enqueue_scripts', function(){
    $theme_informations = wp_get_theme();
    $theme_version      = $theme_informations->get('Version');

    wp_enqueue_script('app-script', get_template_directory_uri() . '/js/app.js', [], $theme_version);
    wp_enqueue_style('app-style', get_template_directory_uri() . '/app.css', [], $theme_version);
});

// Deactivate admin bar 
// Source: https://creativedigital.co.nz/wordpress-hiding-default-content-editor-wysiwyg-for-a-specific-template/
add_filter('show_admin_bar', '__return_false');

// Deactivate wp-emoji
// Source: https://smartcatdesign.net/articles/stop-loading-wp-emoji-release-min-js-wordpress-site/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Custom Timber functions available in *.twig templates
add_filter( 'timber/twig', function( \Twig_Environment $twig ) {
    // Handle menu active
    $twig->addFunction(new Timber\Twig_Function('is_active', function($is_active){
        return $is_active ? "is-active" : "";  
    }));

    return $twig;
});

// Add stuff to Timber context
add_filter( 'timber/context', function($context) {
    // Handle menus (see: https://timber.github.io/docs/guides/menus/)
    $context['navbar']        = new \Timber\Menu('navbar');
    $context['navbar_footer'] = new \Timber\Menu('navbar-footer');

    return $context;
});

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function md_starter_theme_setup() {
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on md-starter-theme, use a find and replace
        * to change 'md-starter-theme' to the name of your theme in all the template files.
        */
    load_theme_textdomain( 'md-starter-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'md_starter_theme_setup' );