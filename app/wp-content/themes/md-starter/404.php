<?php

/**
 * 404 template used to display 404 error page
 */

$context = Timber::get_context();
Timber::render('404.twig', $context);
