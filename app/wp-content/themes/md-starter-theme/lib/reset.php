<?php
/**
 * Reset
 *
 * PHP version 7.2.10
 *
 * @category Reset
 * @package  MD_Starter_Theme
 * @author   Jérémy Levron <jeremylevron@19h47.fr> (http://19h47.fr)
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://19h47.fr
 */

/**
 * Deactivate wp-emoji
 *
 * @see http://wordpress.stackexchange.com/questions/185577/disable-emojicons-introduced-with-wp-4-2
 * @see https://smartcatdesign.net/articles/stop-loading-wp-emoji-release-min-js-wordpress-site/
 * @return void
 */
function md_starter_theme_disable_wp_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}

if ( ! is_admin() ) {
	add_action( 'init', 'md_starter_theme_disable_wp_emoji' );
}
