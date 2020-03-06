<?php
/**
 * MD Starter Class
 *
 * @author Jérémy Levron <jeremylevron@19h47.fr> (http://19h47.fr)
 * @package MD_Starter_Theme
 */

// Include autoload from Composer.
require_once get_template_directory() . '/vendor/autoload.php';

/**
 * Timber
 *
 * Instanciate Timber
 *
 * @see https://github.com/timber/timber
 */
use Timber\Timber as Timber;
use \Twig_SimpleFunction as Twig_SimpleFunction;


/**
 * Timber dirname
 *
 * Declare templates location
 */
Timber::$dirname = array( 'templates' );


/**
 * Class MD_Starter_Theme
 *
 * @author Jérémy Levron <jeremylevron@19h47.fr> (http://19h47.fr)
 */
class Theme extends Timber {

	/**
	 * The name of the theme
	 *
	 * @access private
	 * @var    str
	 */
	private $theme_name;


	/**
	 * The version of this theme
	 *
	 * @access private
	 * @var    str
	 */
	private $theme_version;


	/**
	 * Construct
	 *
	 * Initialize the class and set its properties.
	 *
	 * @access public
	 * @param  str $theme_name    The theme name.
	 * @param  str $theme_version The theme version.
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;

		$this->setup();
		$this->load_dependencies();

		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );

		parent::__construct();
	}


	/**
	 * Load dependencies description
	 *
	 * @access private
	 */
	private function load_dependencies() {
		include_once get_template_directory() . '/lib/reset.php';
		include_once get_template_directory() . '/lib/sanitize-wysiwyg.php';
	}


	/**
	 * Add to Twig
	 *
	 * @param obj $twig Twig environment.
	 * @access public
	 */
	public function add_to_twig( $twig ) {
		// Handle menu active.
		$twig->addFunction(
			new Twig_Function(
				'is_active',
				function( $is_active ) {
					return $is_active ? 'is-active' : '';
				}
			)
		);

		return $twig;
	}


	/**
	 * Add to context
	 *
	 * @param  obj $context Context.
	 * @return $context
	 * @access public
	 */
	public function add_to_context( $context ) {
		// Handle menus (see: https://timber.github.io/docs/guides/menus/).
		$context['navbar']        = new \Timber\Menu( 'navbar' );
		$context['navbar_footer'] = new \Timber\Menu( 'navbar-footer' );

		return $context;
	}


	/**
	 * Setup
	 *
	 * @access public
	 */
	public function setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'after_setup' ) );
	}


	/**
	 * After setup
	 *
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @access public
	 */
	public function after_setup() {
			/**
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'md-starter', get_template_directory() . '/languages' );
	}


	/**
	 * Enqueue styles.
	 *
	 * @access public
	 */
	public function enqueue_style() {
		wp_enqueue_style(
			'app-style',
			get_template_directory_uri() . '/app.css',
			[],
			$this->get_theme_version()
		);
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'app-script',
			get_template_directory_uri() . '/js/app.js',
			[],
			$this->get_theme_version(),
			true
		);
	}


	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since  1.0.0
	 * @return string    The version number of the plugin.
	 */
	public function get_theme_version() {
		return $this->theme_version;
	}


	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string    The name of the plugin.
	 */
	public function get_theme_name() {
		return $this->theme_name;
	}
}

$wp_theme = wp_get_theme();

// Run!
new Theme( 'md-starter', $wp_theme->Version );
