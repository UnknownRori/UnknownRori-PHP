<?php

namespace Core\Http\Route;

use Core\Exception\KernelException;
use Core\Http\Middleware\Middleware;
use Exception;

class Route implements IRoute
{
    protected $route = [
        "GET" => [],
        "POST" => [],
        "PATCH" => [],
        "DELETE" => [],
    ];

    /**
     * Register URI to route
     * Route->get|post|patch|delete('uri', [controller::class, 'method'])
     */
    public static function define($configRoute)
    {
        $route = new static;
        require($configRoute);
        return $route;
    }

    /**
     * Register the uri in http get
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public function get($uri, $controller = [])
    {
        $this->route['GET'][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1]
        ];

        return $this;
    }

    /**
     * Register the uri in http post
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public function post($uri, $controller = [])
    {
        $this->route['POST'][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1]
        ];

        return $this;
    }


    /**
     * Register the uri in http patch
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public function patch($uri, $controller = [])
    {
        $this->route['PATCH'][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1]
        ];

        return $this;
    }

    /**
     * Register the uri in http delete
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public function delete($uri, $controller = [])
    {
        $this->route['DELETE'][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1]
        ];

        return $this;
    }

    public function Redirect($uri, $requestType)
    {
        if (!array_key_exists($uri, $this->route[$requestType])) {
            return KernelException::RouteNotDefined();
        }

        return $this->call($this->route[$requestType][$uri]);
    }

    /**
     * Calling method in the controller
     * @param string route
     */
    protected function call($route)
    {
        $namespacedController = "App\Http\Controller\\{$route['controller']}";

        $controller = new $namespacedController;
        $action = $route['action'];

        if (!method_exists($controller, $action)) {
            KernelException::ClassMethod($route['controller'], $action);
        }

        return $controller->$action();
    }

    /**
     * Calling Middleware
     * @param string $middleware MiddlewareName
     */
    public function middleware($middleware)
    {
        Middleware::RunSingle($middleware);
    }
}
