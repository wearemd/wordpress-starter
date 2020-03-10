<?php
// Include autoload from Composer.
require_once get_template_directory() . '/vendor/autoload.php';

// Documentation: https://github.com/timber/timber
use Timber\Timber as Timber;
use Twig_SimpleFunction as Twig_SimpleFunction;
use Twig\Environment as Twig_Environment;
use Timber\Helper;
use Timber\URLHelper;

// Declare templates location
Timber::$dirname = array( 'templates' );

class Theme extends Timber
{
    private $theme_name;
    private $theme_version;

    public function __construct(string $theme_name, string $theme_version)
    {
        $this->theme_name    = $theme_name;
        $this->theme_version = $theme_version;

        $this->setup();
        $this->load_dependencies();

        add_filter('timber_context', array( $this, 'add_to_context' ));
        add_filter('timber/twig', array( $this, 'add_to_twig' ));

        parent::__construct();
    }


    private function load_dependencies()
    {
        include_once get_template_directory() . '/lib/disable_wp_emoji.php';
    }

    public function add_to_twig(Twig_Environment $twig)
    {
        // Handle menu active.
        $twig->addFunction(
            new Twig_Function(
                'is_active',
                function ($is_active) {
                    return $is_active ? 'is-active' : '';
                }
            )
        );

        // Return the current title
        // If none found use the site name
        $twig->addFunction(
            new Twig_Function(
                'current_title',
                function(){
                    $title = Helper::get_wp_title();

                    if (!$title){
                        $title = get_bloginfo('name');
                    }

                    return $title;
                }
            )
        );

        // Return the current description
        // If none found use the site description
        $twig->addFunction(
            new Twig_Function(
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
        // If none found use `/images/ui/og-image.png`
        $twig->addFunction(
            new Twig_Function(
                'current_thumbnail',
                function () {
                    $protocol = (isset($_SERVER['HTTPS']) ? "https" : "http");
                    $default_thumbnail = get_template_directory_uri()."/images/og-image.png";
                    $thumbnail = get_the_post_thumbnail_url();

                    if (is_home() || !$thumbnail) {
                        $thumbnail = $default_thumbnail;
                    }

                    return $protocol.":".$thumbnail;
                }
            )
        );

        // Return the current url
        $twig->addFunction(
            new Twig_Function(
                'current_url',
                function () {
                    return URLHelper::get_current_url( );
                }
            )
        );

        return $twig;
    }

    public function add_to_context(array $context)
    {
        // Handle menus
        // See: https://timber.github.io/docs/guides/menus/
        $context['navbar']     = new \Timber\Menu('navbar');
        $context['nav_footer'] = new \Timber\Menu('nav-footer');

        return $context;
    }

    public function setup()
    {
        add_action('wp_enqueue_scripts', array( $this, 'enqueue_style' ));
        add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
        add_action('after_setup_theme', array( $this, 'after_setup' ));
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
        load_theme_textdomain('md-starter', get_template_directory() . '/languages');

        // Enable Support for Featured Image
        // Documentation: https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        add_theme_support('post-thumbnails');
    }

    public function enqueue_style()
    {
        wp_enqueue_style(
            'app-style',
            get_template_directory_uri() . '/app.css',
            [],
            $this->get_theme_version()
        );
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'app-script',
            get_template_directory_uri() . '/js/app.js',
            [],
            $this->get_theme_version(),
            true
        );
    }

    public function get_theme_version(): string
    {
        return $this->theme_version;
    }


    // The name of the theme used to uniquely identify it within the context of
    // WordPress and to define internationalization functionality.
    public function get_theme_name(): string
    {
        return $this->theme_name;
    }
}

$wp_theme = wp_get_theme();
new Theme('md-starter', $wp_theme->Version);
