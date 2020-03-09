<?php

/**
 * Page template used to display default page (Legal notices, personal data)
 */

$context         = Timber::get_context();
$context['post'] = new TimberPost();

Timber::render([ 'page.twig' ], $context);
