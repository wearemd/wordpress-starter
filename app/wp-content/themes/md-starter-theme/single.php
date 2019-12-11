<?php
/**
 * Page
 *
 * Template used to display post
 *
 * @package MD_Starter_Theme
 */

$context         = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render( [ 'single.twig' ], $context );
