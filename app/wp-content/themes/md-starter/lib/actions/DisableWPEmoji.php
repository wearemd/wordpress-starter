<?php

namespace Theme\Actions;

/**
 * DisableWPEmoji role is to prevent WordPress to add useless wp-emoji JS.
 */
class DisableWPEmoji
{
    public static function call()
    {
        $action = new self();
        add_action('init', [$action, 'disable_wp_emoji']);
    }

    public function disable_wp_emoji()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
