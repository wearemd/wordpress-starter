<?php

// Include autoload from Composer.
require_once get_template_directory().'/vendor/autoload.php';

use Theme\Theme;

$wp_theme = wp_get_theme();
new Theme('md-starter', $wp_theme->Version);
