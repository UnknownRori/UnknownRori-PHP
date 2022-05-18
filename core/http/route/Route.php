<?php

namespace Core\Http;

use Core\KernelException;

/**
 * Crude implementation routing in php.
 * [Documentation](https://github.com/UnknownRori/UnknownRori-PHP/blob/master/core/docs/usage.md#routing)
 */
class Route implements IRoute
{
    protected static $route = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];

    protected static $nameRoute = [];

    private $method, $uri, $controller, $middleware, $name;

    private static $groupMiddleware, $groupPrefix, $groupName;
    private static $groupMiddlewareIteration = 0;
    private static $groupPrefixIteration = 0;
    private static $groupNameIteration = 0;

    /**
     * Starting point of route class
     * Register all URI to route
     * @param string $configRoute
     */
    public static function define(string $configRoute): self
    {
        $self = new static;

        require($configRoute);

        return $self;
    }

    /**
     * Register the URI on route destruct
     * @return void
     */
    public function __destruct()
    {
        if (isset($this->method)) {

            $this->registerPrefix();

            if (!isset(self::$route[$this->method][$this->uri])) {
                self::$route[$this->method][$this->uri] = ['action' => $this->controller];

                $this->registerMiddleware();
            } else return report('Route already defined!');

            $this->registerName();
        }
    }

    /**
     * Register the URI on `GET` HTTP
     * @param string         $uri
     * @param callable|array $controller
     */
    public static function get(string $uri, callable|array $controller): self
    {
        $self = new static;

        $self->method = 'GET';
        $self->uri = $uri;
        $self->controller = $controller;

        return $self;
    }

    /**
     * Register the URI on `POST` HTTP
     * @param string         $uri
     * @param callable|array $controller
     */
    public static function post(string $uri, callable|array $controller): self
    {
        $self = new static;

        $self->method = 'POST';
        $self->uri = $uri;
        $self->controller = $controller;

        return $self;
    }

    /**
     * Register the URI on `PATCH` HTTP
     * @param string         $uri
     * @param callable|array $controller
     */
    public static function patch(string $uri, callable|array $controller): self
    {
        $self = new static;

        $self->method = 'PATCH';
        $self->uri = $uri;
        $self->controller = $controller;

        return $self;
    }

    /**
     * Register the URI on `DELETE` HTTP
     * @param string         $uri
     * @param callable|array $controller
     */
    public static function delete(string $uri, callable|array $controller): self
    {
        $self = new static;

        $self->method = 'DELETE';
        $self->uri = $uri;
        $self->controller = $controller;

        return $self;
    }

    /**
     * Register name on URI
     * @param  string $name
     * @return self
     */
    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Register name for group URI
     * `Group Method`
     * @param  string $name
     * @return self
     */
    public static function names(string $name): self
    {
        $self = new static;

        self::$groupName[self::$groupNameIteration] = $name;

        self::$groupNameIteration++;

        return $self;
    }

    /**
     * Register prefix for group URI
     * `Group Method`
     * @param  string $uri
     * @return self
     */
    public static function prefix(string $uri): self
    {
        $self = new static;

        self::$groupPrefix[self::$groupPrefixIteration] = $uri;

        self::$groupPrefixIteration++;

        return $self;
    }

    /**
     * Register middleware for group URI.
     * `Group Method`
     * @param  string|array $middleware
     * @return self
     */
    public static function middlewares(string|array $middleware): self
    {
        $self = new static;

        self::$groupMiddleware[self::$groupMiddlewareIteration] = $middleware;

        self::$groupMiddlewareIteration++;

        return $self;
    }

    /**
     * Register middleware on URI
     * @param  string|array $middleware
     * @return self
     */
    public function middleware(string|array $middleware): self
    {
        $self = new static;

        $this->middleware = $middleware;

        return $self;
    }

    /**
     * Initialize Group, chain this method on after `Group Method`
     * @param  callable $closure
     * @return void
     */
    public function group(callable $closure)
    {
        call_user_func($closure);

        if (self::$groupMiddlewareIteration > 0) self::$groupMiddlewareIteration--;
        if (self::$groupNameIteration > 0) self::$groupNameIteration--;
        if (self::$groupPrefixIteration > 0) self::$groupPrefixIteration--;

        unset(self::$groupMiddleware[self::$groupMiddlewareIteration]);
        unset(self::$groupName[self::$groupNameIteration]);
        unset(self::$groupPrefix[self::$groupPrefixIteration]);

        if (self::$groupMiddlewareIteration == 0) self::$groupMiddleware = null;
        if (self::$groupNameIteration == 0) self::$groupName = null;
        if (self::$groupPrefixIteration == 0) self::$groupPrefix = null;
    }

    /**
     * Get named uri
     * @param  string $name
     * @return string uri
     */
    public static function GetRoute($name, $data = []): string
    {
        if (array_key_exists($name, self::$nameRoute)) {
            $uri = self::$nameRoute[$name];
        } else {
            KernelException::RouteNameNotExists($name);
        }

        $value = array_values($data);
        $key = array_keys($data);

        for ($i = 0; $i < count($data); $i++) {
            $uri = $uri . "?{$key[$i]}={$value[$i]}&";
        }

        return $uri;
    }

    /**
     * Redirect to desired named uri
     * @param  string $name route name
     * @param  array  $data passed argumment to include on redirect
     * @return void
     */
    public static function Redirect($name, $data = [])
    {
        $uri = self::GetRoute($name, $data);

        return header("Location: {$uri}");
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
        if (array_key_exists('middleware', $route)) {
            Middleware::Run($route['middleware']);
        }

        if (is_callable($route['action'])) {
            return call_user_func($route['action']);
        } else {

            $namespacedController = "App\Http\Controller\\{$route['controller']}";
            $controller = new $namespacedController;
            $action = $route['action'];


            if (!method_exists($controller, $action)) {
                KernelException::ClassMethod($route['controller'], $action);
            }

            return $controller->$action();
        }
    }

    /**
     * For debugging purposes (only work if `APP_DEBUG` is on)
     * Dumping out all route, named route, and group iteration.
     * @return array|void
     */
    public static function dump(): array
    {
        if (env('APP_DEBUG', false)) return [
            'Route' => self::$route,
            'Named Route' => self::$nameRoute,
            'Group Middleware Interation' => self::$groupMiddlewareIteration,
            'Group Name Interation' => self::$groupNameIteration,
            'Group Prefix Interation' => self::$groupPrefixIteration,
            'Group Name' => self::$groupName,
            'Group Prefix' => self::$groupPrefix,
            'Group Middleware' => self::$groupMiddleware,
        ];
    }

    /**
     * Register prefix on specific route
     * @return void
     */
    private function registerPrefix()
    {
        if (isset(self::$groupPrefix)) {
            $mergedPrefix = $this->mergePrefix();

            if (!array_key_exists($mergedPrefix, self::$nameRoute)) $this->uri = $mergedPrefix;
            else return KernelException::KeyExists($mergedPrefix, 'Route Prefix');
        }
    }

    /**
     * Merging current group prefix with current route
     * @return string
     */
    private function mergePrefix(): string
    {
        $mergePrefix = [];

        if (isset(self::$groupPrefix)) {
            for ($i = 0; $i < count(self::$groupPrefix); $i++) {
                if (isset(self::$groupPrefix[$i])) {
                    if (is_array(self::$groupPrefix[$i])) {
                        $mergePrefix = array_merge($mergePrefix, self::$groupPrefix[$i]);
                    } else {
                        $mergePrefix = array_merge($mergePrefix, [self::$groupPrefix[$i]]);
                    }
                }
            }
        }

        $mergedName = implode('/', $mergePrefix);
        return "{$mergedName}/{$this->uri}";
    }

    /**
     * Register name on specific route
     * @return void
     */
    private function registerName()
    {
        if (isset(self::$groupName)) {
            $mergedName = $this->mergeName();

            if (!array_key_exists($mergedName, self::$nameRoute)) self::$nameRoute[$mergedName] = $this->uri;
            else return KernelException::KeyExists($mergedName, 'Named Route');
        } else if (isset($this->name)) {
            if (!isset(self::$nameRoute[$this->name])) self::$nameRoute[$this->name] = $this->uri;
            else return KernelException::KeyExists($this->name, 'Named Route');
        }
    }

    /**
     * Mergin current name group with current name route
     * @return string
     */
    private function mergeName(): string
    {
        $mergedName = [];

        if (isset(self::$groupName)) {
            for ($i = 0; $i < count(self::$groupName); $i++) {
                if (isset(self::$groupName[$i])) {
                    if (is_array(self::$groupName[$i])) {
                        $mergedName = array_merge($mergedName, self::$groupName[$i]);
                    } else {
                        $mergedName = array_merge($mergedName, [self::$groupName[$i]]);
                    }
                }
            }
        }

        $mergedName = implode('.', $mergedName);
        return "{$mergedName}.{$this->name}";
    }

    /**
     * Register middleware with current route
     * @return void
     */
    private function registerMiddleware(): void
    {
        if (isset(self::$groupMiddleware)) {
            $mergedMiddleware = $this->mergeMiddleware();

            if (isset($this->middleware)) {
                if (is_array($this->middleware)) $mergedMiddleware = array_merge($mergedMiddleware, $this->middleware);
                else $mergedMiddleware = array_merge($mergedMiddleware, [$this->middleware]);
            }

            self::$route[$this->method][$this->uri] = array_merge(
                self::$route[$this->method][$this->uri],
                ['middleware' => $mergedMiddleware]
            );
        } else {
            if (isset($this->middleware)) {
                self::$route[$this->method][$this->uri] = array_merge(
                    self::$route[$this->method][$this->uri],
                    ['middleware' => $this->middleware]
                );
            }
        }
    }

    /**
     * Merge the middleware group with current middleware
     * @return array
     */
    private function mergeMiddleware(): array
    {
        $mergedMiddleware = [];

        for ($i = 0; $i < count(self::$groupMiddleware); $i++) {
            if (isset(self::$groupMiddleware[$i])) {
                if (is_array(self::$groupMiddleware[$i])) {
                    $mergedMiddleware = array_merge($mergedMiddleware, self::$groupMiddleware[$i]);
                } else {
                    $mergedMiddleware = array_merge($mergedMiddleware, [self::$groupMiddleware[$i]]);
                }
            }
        }

        return $mergedMiddleware;
    }
}
