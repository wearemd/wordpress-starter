<?php
/**
 * Page
 *
 * Template used to display default page (Legal notices, personal data)
 *
 * @package MD_Starter
 */

$context         = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render( [ 'page.twig' ], $context );
