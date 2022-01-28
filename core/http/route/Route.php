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

    private $temp = [];

    /**
     * Starting Point of Route class to Register URI to route
     * Route->get|post|patch|delete('uri', [controller::class, 'method'])
     */
    public static function define($configRoute)
    {
        $route = new static;
        require($configRoute);
        return $route;
    }

    /**
     * Register the uri in http get request
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public function get($uri, $controller = [])
    {
        $this->route['GET'][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1]
        ];

        $this->temp($uri, 'GET');

        return $this;
    }

    /**
     * Register the uri in http post request
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
     * Register the uri in http patch request
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
     * Register the uri in http delete request
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

    /**
     * TODO! for easier redirect
     */
    public function name()
    {
        return $this;
    }

    /**
     * TODO! for future SEO friendly URI
     */
    public function whereNumber($parameter)
    {
        return $this;
    }

    /**
     * Register middleware that can be called
     * @param string $middleware MiddlewareName
     */
    public function middleware($middleware)
    {
        // TODO! MAKE THIS SYNTAX MORE ELEGANT!
        $this->route[$this->temp['method']][$this->temp['uri']] = array_merge(
            ["middleware" => $middleware],
            $this->route[$this->temp['method']][$this->temp['uri']]
        );

        return $this;
    }

    /**
     * Run the specific route register
     * @param string $uri
     * @param string $requestType
     */
    public function Run($uri, $requestType)
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

        Middleware::RunSingle($route['middleware']);

        if (!method_exists($controller, $action)) {
            KernelException::ClassMethod($route['controller'], $action);
        }

        return $controller->$action();
    }

    /**
     * Create Temporary Object Property
     */
    protected function temp($uri, $requestType)
    {
        $this->temp = [
            "method" => $requestType,
            "uri" => $uri
        ];
    }

    /**
     * Commented because, it might be needed later
     */
    // protected function get_route($uri, $requestType, $target = '')
    // {
    //     return $this->route[$requestType][$uri][$target];
    // }

    /**
     * TODO! for future SEO friendly URI
     */
    protected function URIGenerator($route)
    {
    }
}
