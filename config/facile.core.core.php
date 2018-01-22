<?php

return [
    'title' => 'Facile',
    'admin-prefix' => 'cms',

    'middleware' => [
        'backend' => [
            'web',
            'auth:facile',
            //'facile.privilege', 
        ],
        'frontend' => [
            'web',
            'guest:facile',
        ],
        'api' => [
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Location where your themes are located
    |--------------------------------------------------------------------------
    */
    'themes_path' => base_path() . '/Themes',
    'admin-theme' => 'Admin',
    'admin-theme-include-vendor' => ['sidebar'],
    'admin-assets' => [
        // Css
        'facile_styles.css' => ['theme' => 'css/facile_styles.css'],
        // Javascript
        'facile_main.js' => ['theme' => 'js/facile_main.js'],
        'facile_plugins.js' => ['theme' => 'js/facile_plugins.js'],
    ],
    'redirect_login_url' => 'facile.dashboard.index',
    'redirect_forgot_url' => 'facile.forgot.success',
    'admin-required-assets' => [
        'css' => [
            'facile_styles.css',
        ],
        'js' => [
            'facile_main.js',
            'facile_plugins.js',
        ],
    ],
    'admin-menu' => [
        //'message',
        //'notification',
        //'selector',
        'changepassword',
        //'changelog',
        //'changeprofile',
    ],
    //'selector-menu-name' => 'Group',
];