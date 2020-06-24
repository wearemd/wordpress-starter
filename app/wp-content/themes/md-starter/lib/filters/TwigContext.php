<?php

namespace Theme\Filters;

/**
 * TwigContext role is to add various data to the Twig context.
 * Actually it adds:
 * - menus.
 */
class TwigContext
{
    public static function call()
    {
        $filter = new self();
        add_filter('timber_context', [$filter, 'menu']);
    }

    public function menu(array $context)
    {
        // Handle menus
        // See: https://timber.github.io/docs/guides/menus/
        $context['navbar'] = new \Timber\Menu('navbar');
        $context['nav_footer'] = new \Timber\Menu('nav-footer');

        return $context;
    }
}
