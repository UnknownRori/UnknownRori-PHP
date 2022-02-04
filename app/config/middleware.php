<?php

/**
 * This is where to register named middleware or group
 */
return [
    /**
     * Register middleware custom group middleware middleware class
     * Middleware::RunAll('namedMiddleware');
     * example : Middleware::RunAll('runtime');
     */
    'runtime' => [
        App\Http\Middleware\test::class, // This is still for testing purposes
    ],

    /**
     * Register middleware named can be used using route or middleware class
     * route : $route->get('uri', [controller:class, 'method'])->middleware('namedMiddleware');
     * Middleware::Run('namedMiddleware');
     */
    'named' => [
        'test' => App\Http\Middleware\test::class, // This is still for testing purposes
        'auth' => App\Http\Middleware\auth::class
    ]
];
