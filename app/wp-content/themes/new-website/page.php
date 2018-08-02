<?php

// Template used to display default page (Legal notices, personal data)

$context         = Timber::get_context();
$post            = new TimberPost();
$context['post'] = $post;

Timber::render(['page.twig'], $context);
