<?php

namespace Theme;

// Documentation: https://github.com/timber/timber
use Timber\Timber as Timber;

// Declare templates location
Timber::$dirname = ['templates'];

/**
 * Theme is the main class for this theme, it registers every actions, filters, plugins,
 * post types and taxonomies.
 */
class Theme extends Timber
{
    const POST_THUMBNAIL_SIZE = '1280x640';

    public function __construct()
    {
        $this->setup();

        // Call actions hooks required by this Theme
        // Documentation: https://developer.wordpress.org/plugins/hooks/actions/
        Actions\AfterSetupTheme::call();
        Actions\DisableWPEmoji::call();
        Actions\EnqueueStyles::call($this);
        Actions\EnqueueScripts::call($this);

        // Call filters hooks required by this Theme
        // Documentation: https://developer.wordpress.org/plugins/hooks/filters/
        Filters\TwigContext::call();
        Filters\TwigFunctions::call($this);

        parent::__construct();
    }

    private function setup()
    {
        $wp_theme = wp_get_theme();
        $this->theme_version = $wp_theme->Version;
        $this->set_post_thumbnail_size();
    }

    private function set_post_thumbnail_size()
    {
        $sizes = explode('x', self::POST_THUMBNAIL_SIZE);
        $width = intval($sizes[0]);
        $height = intval($sizes[1]);
        set_post_thumbnail_size($width, $height, true);
    }
}
