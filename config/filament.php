<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filament Config (minimal)
    |--------------------------------------------------------------------------
    |
    | Keep this file serializable (no Panel::make() objects). Panels are
    | registered by App\Providers\FilamentPanelProvider so the config only
    | needs to contain scalar values consumed elsewhere.
    |
    */

    'default_panel' => 'admin',

    'panels' => [
        'admin' => [
            'id' => 'admin',
            'path' => 'admin', // URL will be /admin
            'login' => true,
            'colors' => [
                'primary' => '#4f46e5',
            ],
            'middleware' => [
                'web',
            ],
            'auth_guard' => 'web',
        ],
    ],

];
