<?php

namespace Theme;

// Documentation: https://github.com/timber/timber
use Timber\Helper;
use Timber\Timber as Timber;
use Timber\URLHelper;
use Twig\Environment as Twig_Environment;
use Twig_SimpleFunction as Twig_SimpleFunction;

// Declare templates location
Timber::$dirname = ['templates'];

class Theme extends Timber
{
    const POST_THUMBNAIL_SIZE = '1280x640';
    private $theme_name;
    private $theme_version;

    public function __construct(string $theme_name, string $theme_version)
    {
        $this->theme_name = $theme_name;
        $this->theme_version = $theme_version;

        $this->setup();
        $this->load_dependencies();

        add_filter('timber_context', [$this, 'add_to_context']);
        add_filter('timber/twig', [$this, 'add_to_twig']);

        parent::__construct();
    }

    public function setup()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_style']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('after_setup_theme', [$this, 'after_setup']);
        $this->set_post_thumbnail_size();
    }

    public function add_to_context(array $context)
    {
        // Handle menus
        // See: https://timber.github.io/docs/guides/menus/
        $context['navbar'] = new \Timber\Menu('navbar');
        $context['nav_footer'] = new \Timber\Menu('nav-footer');

        return $context;
    }

    public function add_to_twig(Twig_Environment $twig)
    {
        // Handle menu active.
        $twig->addFunction(
            new Twig_SimpleFunction(
                'is_active',
                function ($is_active) {
                    return $is_active ? 'is-active' : '';
                }
            )
        );

        // Return the current title
        // If none found use the site name
        $twig->addFunction(
            new Twig_SimpleFunction(
                'current_title',
                function () {
                    $title = Helper::get_wp_title();

                    if (!$title) {
                        $title = get_bloginfo('name');
                    }

                    return $title;
                }
            )
        );

        // Return the current description
        // If none found use the site description
        $twig->addFunction(
            new Twig_SimpleFunction(
                'current_description',
                function () {
                    $description = get_the_excerpt();

                    if (is_home() || empty($description)) {
                        $description = get_bloginfo('description');
                    }

                    return $description;
                }
            )
        );

        // Return the current thumbnail
        // If none found use `/images/og-image.jpg`
        $twig->addFunction(
            new Twig_SimpleFunction(
                'current_thumbnail',
                function () {
                    $default_thumbnail = get_template_directory_uri().'/images/og-image.jpg';
                    $thumbnail = get_the_post_thumbnail_url();

                    if (is_home() || !$thumbnail) {
                        $thumbnail = $default_thumbnail;
                    }

                    return $thumbnail.'?ver='.$this->get_theme_version();
                }
            )
        );

        // Return the current url
        $twig->addFunction(
            new Twig_SimpleFunction(
                'current_url',
                function () {
                    return URLHelper::get_current_url();
                }
            )
        );

        return $twig;
    }

    // After setup
    // Sets up theme defaults and registers support for various WordPress features.
    // Note that this function is hooked into the after_setup_theme hook, which
    // runs before the init hook. The init hook is too late for some features, such
    // as indicating support for post thumbnails.
    public function after_setup()
    {
        // Make theme available for translation.
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain('md-starter', get_template_directory().'/languages');

        // Enable Support for Featured Image
        // Documentation: https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        add_theme_support('post-thumbnails');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'app-script',
            get_template_directory_uri().'/js/app.js',
            [],
            $this->get_theme_version(),
            true
        );
    }

    public function enqueue_style()
    {
        wp_enqueue_style(
            'app-style',
            get_template_directory_uri().'/app.css',
            [],
            $this->get_theme_version()
        );
    }

    // The name of the theme used to uniquely identify it within the context of
    // WordPress and to define internationalization functionality.
    public function get_theme_name(): string
    {
        return $this->theme_name;
    }

    public function get_theme_version(): string
    {
        return $this->theme_version;
    }

    private function load_dependencies()
    {
        include_once get_template_directory().'/lib/disable_wp_emoji.php';
    }

    private function set_post_thumbnail_size()
    {
        $sizes = explode('x', self::POST_THUMBNAIL_SIZE);
        $width = intval($sizes[0]);
        $height = intval($sizes[1]);
        set_post_thumbnail_size($width, $height, true);
    }
}
