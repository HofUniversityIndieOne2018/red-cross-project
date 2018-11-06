<?php

/**
 * Extension Manager/Repository config file for ext "red_cross_site".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Red Cross Site',
    'description' => 'Site Package',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'rte_ckeditor' => '8.7.0-9.5.99',
            'bootstrap_package' => '10.0.0-10.0.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'OliverHader\\RedCrossSite\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Oliver Hader',
    'author_email' => 'oliver@typo3.org',
    'author_company' => 'Oliver Hader',
    'version' => '1.0.0',
];
