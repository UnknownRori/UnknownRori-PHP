<?php

namespace Core\Http\Middleware;

use Core\Exception\KernelException;
use Exception;

class Middleware
{
    protected $middleware = [];

    /**
     * Initialize Middleware instance
     */
    public static function Provide()
    {
        $class = new static();
        $class->middleware = require("{$_ENV['APP_DIR']}\\config\middleware.php");
        return $class;
    }

    /**
     * Run all middleware with specific type
     */
    public function Run($type)
    {
        array_map(function ($namespace) {
            $middleware = new $namespace;
            $middleware->Run();
        }, $this->middleware[$type]);
    }

    /**
     * Run specific named middleware
     */
    public static function RunSingle(array | string $middleware)
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
