<?php

namespace Theme\Actions;

use Theme\Theme;

/**
 * EnqueueScripts role is to register scripts used by this theme.
 */
class EnqueueScripts
{
    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public static function call(Theme $theme)
    {
        $action = new self($theme);
        add_action('wp_enqueue_scripts', [$action, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'app-script',
            get_template_directory_uri().'/js/app.js',
            [],
            $this->theme->theme_version,
            true
        );
    }
}
