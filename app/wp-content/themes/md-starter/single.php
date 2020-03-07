<?php
/**
 * Single
 *
 * Template used to display post
 *
 * @package MD_Starter
 */

$context          = Timber::get_context();
$post             = Timber::query_post();
$context['post']  = $post;

// content['posts'] will be populated with 3 posts ordered by date which share the same categories as the
// current post. If none are found the same query will be done without the categories parameter - @awea 20191211
$related_posts_query = [
    'post__not_in' => array($post->ID),
    'category__in' => array_map(function($c){ return $c->ID; }, $post->categories),
    'posts_per_page' => 3,
    'orderby' => array(
        'date' => 'desc'
    )
];
$posts = new Timber\PostQuery($related_posts_query);

if (count($posts) == 0) {
    unset($related_posts_query['category__in']);
    $posts = new Timber\PostQuery($related_posts_query);
}

$context['posts'] = $posts;

Timber::render( [ 'single.twig' ], $context );
