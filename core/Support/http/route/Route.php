<?php

namespace Core\Support\Http;

use Core\KernelException;
use Core\Support\Http\Middleware;

class Route implements IRoute
{
    protected static $route = [
        "GET" => [],
        "POST" => [],
        "PATCH" => [],
        "DELETE" => [],
    ];

    protected static $nameRoute = [];

    private static $temp = [];

    /**
     * Starting Point of Route class to Register URI to route
     * Route::get|post|patch|delete('uri', [controller::class, 'method'])
     * @param  string $configRoute Configuration File
     * @return this
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
    public static function get($uri, $controller = [])
    {
        $self = new static;

        self::setRoute('GET', $uri, $controller);

        self::temp('uri', $uri);
        self::temp('method', 'GET');

        return $self;
    }

    /**
     * Register the uri in http post request
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public static function post($uri, $controller = [])
    {
        $self = new static;

        self::setRoute('POST', $uri, $controller);

        self::temp('uri', $uri);
        self::temp('method', 'POST');

        return $self;
    }


    /**
     * Register the uri in http patch request
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public static function patch($uri, $controller = [])
    {
        $self = new static;

        self::setRoute('PATCH', $uri, $controller);

        self::temp('uri', $uri);
        self::temp('method', 'PATCH');

        return $self;
    }

    /**
     * Register the uri in http delete request
     * @param string $uri that you want to register
     * @param array $controller [controllername::class, 'method']
     */
    public static function delete($uri, $controller = [])
    {
        $self = new static;

        self::setRoute('DELETE', $uri, $controller);

        self::temp('uri', $uri);
        self::temp('method', 'DELETE');

        return $self;
    }

    /**
     * Register multiple route into same middleware
     * @param  callable $callback
     * @return void
     */
    public static function group(callable $callback)
    {
        call_user_func($callback);
    }

    /**
     * This method is used to automatic register the route
     * @param string $method Route HTTP Request Type
     * @param string $uri Route URI
     * @param array  $controller Route Controller
     */
    protected static function setRoute(string $method, string $uri, array $controller)
    {
        self::$route[$method][$uri] = [
            "controller" => $controller[0],
            "action" => $controller[1],
        ];
    }

    /**
     * Register route into named route
     * @param  string $name
     * @return this
     */
    public function name($name)
    {
        if (!array_key_exists($name, self::$nameRoute)) {
            self::$nameRoute[$name] = self::$temp['uri'];
        } else {
            KernelException::KeyExists($name, 'Name Route');
        }

        return $this;
    }

    /**
     * Get named uri
     * @param  string $name
     * @return string uri
     */
    public static function GetRoute($name)
    {
        return self::$nameRoute[$name];
    }

    /**
     * Redirect to desired named uri
     * @param  string $name route name
     * @param  array  $data passed argumment to include on redirect
     * @return void
     */
    public static function Redirect($name, array $data = null)
    {
        if (is_null($data)) {
            $uri = self::GetRoute($name);
        } else {
            $uri = self::GetRoute($name) . '?';
            $value = array_values($data);
            $key = array_keys($data);
            for ($i = 0; $i < count($data); $i++) {
                $uri = $uri . "{$key[$i]}={$value[$i]}&";
            }
        }

        return header("Location: {$uri}");
    }

    /**
     * Register middleware that can be called
     * @param  string $middleware MiddlewareName
     * @return this
     */
    public static function middleware($middleware)
    {
        $self = new static;

        self::temp('middleware', $middleware);

        self::setMiddleware();

        return $self;
    }

    /**
     * This method used to register the temp uri with the temp middleware
     * @return void
     */
    protected static function setMiddleware()
    {
        self::$route[self::$temp['method']][self::$temp['uri']] = array_merge(
            ["middleware" => self::$temp['middleware']],
            self::$route[self::$temp['method']][self::$temp['uri']]
        );

        unset(self::$temp['middleware']);
    }

    /**
     * Run the specific route register
     * @param string $uri
     * @param string $requestType
     * @return mixed
     */
    public function Run($uri, $requestType)
    {
        if (!array_key_exists($uri, self::$route[$requestType])) {
            return KernelException::RouteNotDefined();
        }

        return $this->call(self::$route[$requestType][$uri]);
    }

    /**
     * Calling method in the controller
     * @param string route
     * @return void
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
    protected static function temp($key, $value = null)
    {
        if (is_null($value)) {
            if (array_key_exists($key, self::$temp)) {
                return self::$temp[$key];
            }
            return false;
        }

        self::$temp[$key] = $value;
    }

    /**
     * This is to dump out all the current static property
     */
    public static function dump()
    {
        return ['temp' => self::$temp, 'route' => self::$route, 'nameRoute' => self::$nameRoute];
    }
}
