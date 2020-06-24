<?php

namespace Theme\Actions;

use Theme\Theme;

/**
 * EnqueueStyles role is to register stylesheets used by this theme.
 */
class EnqueueStyles
{
    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public static function call(Theme $theme)
    {
        $action = new self($theme);
        add_action('wp_enqueue_scripts', [$action, 'enqueue_styles']);
    }

    public function enqueue_styles()
    {
        wp_enqueue_style(
            'app-style',
            get_template_directory_uri().'/app.css',
            [],
            $this->theme->theme_version
        );
    }
}
