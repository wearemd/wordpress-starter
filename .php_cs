<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/app/wp-content/themes')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PhpCsFixer' => true,
        'ordered_class_elements' => [
            'sortAlgorithm' => 'alpha',
        ],
    ])
    ->setFinder($finder)
;
