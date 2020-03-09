<?php

use Timber\Timber;

if (! class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$context = Timber::get_context();
$context['is_home'] = true;
$context['post'] = new TimberPost();

$templates = array( 'index.twig' );

Timber::render($templates, $context);
