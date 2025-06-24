<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Background Images Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for background images used
    | throughout the application. You can easily change background images
    | by updating the file names here.
    |
    */

    'default' => 'main-bg.jpg',

    'pages' => [
        // Main Pages
        'home' => [
            'image' => 'home-bg.jpg',
            'class' => 'bg-home',
            'overlay' => 'bg-overlay',
        ],
        
        // Authentication Pages
        'login' => [
            'image' => 'auth-bg.jpg',
            'class' => 'bg-auth',
            'overlay' => 'bg-overlay-light',
        ],
        'register' => [
            'image' => 'auth-bg.jpg',
            'class' => 'bg-auth',
            'overlay' => 'bg-overlay-light',
        ],
        
        // Admin Pages
        'admin.dashboard' => [
            'image' => 'admin-bg.jpg',
            'class' => 'bg-admin',
            'overlay' => 'bg-overlay',
        ],
        'admin.*' => [
            'image' => 'admin-bg.jpg',
            'class' => 'bg-admin',
            'overlay' => 'bg-overlay',
        ],
        
        // Destinations Pages
        'destinations.*' => [
            'image' => 'destinations-bg.jpg',
            'class' => 'bg-destinations',
            'overlay' => 'bg-overlay',
        ],
        'wisata.*' => [
            'image' => 'destinations-bg.jpg',
            'class' => 'bg-destinations',
            'overlay' => 'bg-overlay',
        ],
        
        // Search Page
        'search' => [
            'image' => 'search-bg.jpg',
            'class' => 'bg-search',
            'overlay' => 'bg-overlay',
        ],
        
        // Categories Pages
        'categories.*' => [
            'image' => 'destinations-bg.jpg',
            'class' => 'bg-destinations',
            'overlay' => 'bg-overlay',
        ],
        
        // User Profile Pages
        'user.*' => [
            'image' => 'main-bg.jpg',
            'class' => 'bg-main',
            'overlay' => 'bg-overlay',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Background Image Directory
    |--------------------------------------------------------------------------
    |
    | The directory where background images are stored relative to public path
    |
    */
    'directory' => 'images/backgrounds',

    /*
    |--------------------------------------------------------------------------
    | Fallback Images
    |--------------------------------------------------------------------------
    |
    | Fallback images to use when the specified image doesn't exist
    |
    */
    'fallbacks' => [
        'main-bg.jpg',
        'default-bg.jpg',
    ],
];
