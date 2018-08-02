<?php
/**
 * Template Name: Blog
 */

// This template is also used by category.php - 2018/07/03
$context = Timber::get_context();
$post    = new TimberPost();

$context['post']             = $post;
$context['current_category'] = get_term_by('id', get_queried_object_id(), 'category');

function next_page_count_to_context(&$context, $posts_total, $posts_per_page) {
    $posts_next_page_count = $posts_total - $posts_per_page;

    if ($posts_next_page_count <= 0) {
        $posts_next_page_count = 0; 
    } else if ($posts_next_page_count > $posts_per_page) {
        $posts_next_page_count = $posts_per_page; 
    }

    $context['posts_next_page_count'] = $posts_next_page_count;
    $context['posts_total']           = $posts_total;
    $context['posts_per_page']        = $posts_per_page;
}

// If there is a category set we are in category page. 
// `get_template` doesn't seems to works here. - 2018/07/03
if ($context['current_category'] != null){
    $posts_per_page = 12;
    $posts_total    = $context['current_category']->count;

    next_page_count_to_context($context, $posts_total, $posts_per_page);

    $context['force_menu_active'] = true;
    $context['extra_body_class']  = 'blog-category';
    $context['posts']             = new Timber\PostQuery([
        'posts_per_page' => $posts_per_page,
        'paged' => 1,
        'category_name' => $context['current_category']->name
    ]);
} else {
    $posts_per_page = 11;
    $posts_total    = wpml_count_posts();

    next_page_count_to_context($context, $posts_total, $posts_per_page);

    $context['extra_body_class'] = 'blog-list';
    $context['posts']            = new Timber\PostQuery([
        'posts_per_page' => $posts_per_page,
        'paged' => 1,
        'orderby' => array(
            'date' => 'DESC'
        )
    ]);    
}

Timber::render(['blog.twig'], $context );
