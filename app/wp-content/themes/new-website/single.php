<?php
// Template for post_type: post.

$context          = Timber::get_context();
$post             = Timber::query_post();
$context['post']  = $post;
$context['posts'] = $jobs = new Timber\PostQuery([
    'post__not_in' => [$post->ID],
    'posts_per_page' => 2,
    'orderby' => [
        'rand',
        'date' => 'desc'
    ]
]);

Timber::render(['single.twig'], $context);
