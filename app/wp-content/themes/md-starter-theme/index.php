<?php

/**
 * Template Name: Home
 */

$context = Timber::get_context();
$post    = new TimberPost();

$context['is_home'] = true;
$context['post']    = $post;
$context['posts']   = $jobs = new Timber\PostQuery([
    'posts_per_page' => 3,
    'orderby' => array(
        'rand',
        'date' => 'desc'
    )
]);

Timber::render(['index.twig'], $context );
