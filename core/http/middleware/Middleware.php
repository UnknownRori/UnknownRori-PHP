<?php

namespace Core\Http;

use Core\KernelException;

class Middleware implements IMiddleware
{
    protected $middleware = [];

    /**
     * Initialize Middleware instance
     * @return static
     */
    protected static function Provide()
    {
        $class = new static();
        $class->middleware = require("{$_ENV['APP_DIR']}/config/middleware.php");
        return $class;
    }

    /**
     * Run all middleware with specific type
     * can be configured in app/config/middleware.php
     * @param  string $type
     * @return void
     */
    public static function RunAll(string $type)
    {
        $self = Middleware::Provide();

        array_map(function ($namespace) {
            $middleware = new $namespace;
            $middleware->Run();
        }, $self->middleware[$type]);
    }

    /**
     * Run specific named middleware,
     * can be configured in app/config/middleware.php
     * @param  string|array $middleware
     * @return void
     */
    public static function Run(array | string $middleware)
    {
        $self = Middleware::Provide();
        if (is_array($middleware)) {
            array_map(function ($middleware) use ($self) {
                if (array_key_exists($middleware, $self->middleware['named'])) {
                    $namespace = $self->middleware['named'][$middleware];
                    $middleware = new $namespace;
                    $middleware->Run();
                } else {
                    KernelException::MiddlewareNotDefined();
                }
            }, $middleware);
        } else {
            if (array_key_exists($middleware, $self->middleware['named'])) {
                $namespace = $self->middleware['named'][$middleware];
                $middleware = new $namespace;
                $middleware->Run();
            } else {
                KernelException::MiddlewareNotDefined();
            }
        }
    }
}