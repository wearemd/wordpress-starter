<?php

// Disabling WordPress emoji
// See http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
// See https://smartcatdesign.net/articles/stop-loading-wp-emoji-release-min-js-wordpress-site/
function md_starter_disable_wp_emoji()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}

if (! is_admin()) {
    add_action('init', 'md_starter_disable_wp_emoji');
}
