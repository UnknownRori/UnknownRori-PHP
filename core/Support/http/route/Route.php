<?php

namespace Core\Support\Http;

use Core\KernelException;
use Core\Support\Http\Middleware;

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

        $this->temp($uri, 'POST');

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

        $this->temp($uri, 'PATCH');

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

        $this->temp($uri, 'DELETE');

        return $this;
    }

    /**
     * Assign middleware inside group of route
     */
    public function group(string | array $middleware, array $route)
    {
        if (array_key_exists('get', $route)) {
            array_map(function ($data) use ($middleware) {
                if (array_key_exists(2, $data)) {
                    $this->get($data[0], [$data[1][0], $data[1][1]])->middleware($middleware)->name($data[2]);
                } else {
                    $this->get($data[0], [$data[1][0], $data[1][1]])->middleware($middleware);
                }
            }, $route['get']);
        }
        if (array_key_exists('post', $route)) {
            array_map(function ($data)  use ($middleware) {
                if (array_key_exists(2, $data)) {
                    $this->post($data[0], [$data[1][0], $data[1][1]])->middleware($middleware)->name($data[2]);
                } else {
                    $this->post($data[0], [$data[1][0], $data[1][1]])->middleware($middleware);
                }
            }, $route['post']);
        }
        if (array_key_exists('patch', $route)) {
            array_map(function ($data) use ($middleware) {
                if (array_key_exists(2, $data)) {
                    $this->patch($data[0], [$data[1][0], $data[1][1]])->middleware($middleware)->name($data[2]);
                } else {
                    $this->patch($data[0], [$data[1][0], $data[1][1]])->middleware($middleware);
                }
            }, $route['patch']);
        }
        if (array_key_exists('delete', $route)) {
            array_map(function ($data) use ($middleware) {
                if (array_key_exists(2, $data)) {
                    $this->delete($data[0], [$data[1][0], $data[1][1]])->middleware($middleware)->name($data[2]);
                } else {
                    $this->delete($data[0], [$data[1][0], $data[1][1]])->middleware($middleware);
                }
            }, $route['delete']);
        }
    }

    /**
     * TODO! for easier redirect
     */
    public function name($name)
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

        if (array_key_exists('middleware', $route)) {
            Middleware::Run($route['middleware']);
        }

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
