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
    'web' => [
        App\Http\Middleware\TimeExecutionMonitor::class,
        App\Http\Middleware\VerifyCSRF::class,
    ],

    'api' => [
        //
    ],

    /**
     * Register middleware named can be used using route or middleware class
     * route : $route->get('uri', [controller:class, 'method'])->middleware('namedMiddleware');
     * Middleware::Run('namedMiddleware');
     */
    'named' => [
        'auth' => App\Http\Middleware\Authentication::class
    ]
];
