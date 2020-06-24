<?php

namespace Theme\Actions;

/**
 * After setup
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
class AfterSetupTheme
{
    public function after_setup_theme()
    {
        // Make theme available for translation.
        // Translations can be filled in the /languages/ directory
        load_theme_textdomain('md-starter', get_template_directory().'/languages');

        // Enable Support for post thumbnails
        // Documentation: https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        add_theme_support('post-thumbnails');
    }

    public static function call()
    {
        $action = new self();
        add_action('after_setup_theme', [$action, 'after_setup_theme']);
    }
}
