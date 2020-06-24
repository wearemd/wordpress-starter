<?php

namespace Theme\Filters;

use Theme\Theme;
use Timber\Helper;
use Timber\URLHelper;
use Twig\Environment as Twig_Environment;
use Twig\TwigFunction;

/**
 * TwigFunctions role is to register functions that can be used within Twig templates.
 * Actually it adds:
 * - is_active(bool $is_active)
 * - current_title
 * - current_description
 * - current_thumbnail
 * - current_url.
 */
class TwigFunctions
{
    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function add_to_twig(Twig_Environment $twig)
    {
        // Handle menu active.
        $twig->addFunction(
            new TwigFunction(
                'is_active',
                function ($is_active) {
                    return $is_active ? 'is-active' : '';
                }
            )
        );

        // Return the current title
        // If none found use the site name
        $twig->addFunction(
            new TwigFunction(
                'current_title',
                function () {
                    $title = Helper::get_wp_title();

                    if (!$title) {
                        $title = get_bloginfo('name');
                    }

                    return $title;
                }
            )
        );

        // Return the current description
        // If none found use the site description
        $twig->addFunction(
            new TwigFunction(
                'current_description',
                function () {
                    $description = get_the_excerpt();

                    if (is_home() || empty($description)) {
                        $description = get_bloginfo('description');
                    }

                    return $description;
                }
            )
        );

        // Return the current thumbnail
        // If none found use `/images/og-image.jpg`
        $twig->addFunction(
            new TwigFunction(
                'current_thumbnail',
                function () {
                    $default_thumbnail = get_template_directory_uri().'/images/og-image.jpg';
                    $thumbnail = get_the_post_thumbnail_url();

                    if (is_home() || !is_single() || !$thumbnail) {
                        $thumbnail = $default_thumbnail;
                    }

                    return $thumbnail.'?ver='.$this->theme->theme_version;
                }
            )
        );

        // Return the current url
        $twig->addFunction(
            new TwigFunction(
                'current_url',
                function () {
                    return URLHelper::get_current_url();
                }
            )
        );

        return $twig;
    }

    public static function call(Theme $theme)
    {
        $filter = new self($theme);
        add_filter('timber/twig', [$filter, 'add_to_twig']);
    }
}
