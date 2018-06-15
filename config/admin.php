<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-4-6
 * Time: 下午11:15
 */

return [

    'auth' => [
        'guards' => [
            'administrator' => [
                'driver'   => 'session',
                'provider' => 'administrators',
            ],
        ],

        'providers' => [
            'administrators' => [
                'driver' => 'eloquent',
                'model'  => \App\Models\Administrator::class,
            ],
        ],
    ],

    /*
     * Route configuration.
     */
    'route' => [

        'prefix' => 'admin',

        'namespace' => 'App\\Http\\Controllers\\Admin',

        'middleware' => ['web', 'admin'],
    ],

    /*
     * Use `https`.
     */
    'secure' => false,

    /*
     * 无需验证权限的路由
     */
    'permission_except' => [
        'login.getLogin',
        'login.postLogin',
        'login.logout',
        'home.index'
    ]
];