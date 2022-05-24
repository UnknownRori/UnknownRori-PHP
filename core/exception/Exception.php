<?php

namespace Core;

use Core\Http\Route;
use Core\Utils\Json;
use Exception;

/**
 * Handle kernel exception
 */
class KernelException implements IException
{

    /**
     * Initialize UnknownRori-PHP Custom Exception Handler
     * @return  void
     */
    public static function init()
    {
        if (!env('APP_DEBUG', true));
        if (extension_loaded("xdebug")) return;
        set_exception_handler(function ($e) {
            echo "<pre style='{$_ENV["ERROR_STYLE"]}'>";
            throw new Exception($e);
            echo '</pre>';
            die;
        });
    }

    /**
     * Throw Exception about Route not defined
     */
    public static function routeNotDefined()
    {
        http_response_code(404);
        if (env('APP_DEBUG', true)) {
            if(Route::$api) {
                echo Json::Encode(['message' => 'Route not found!']);
            }else {
                throw new Exception("Route is not defined, did you forget to register it in web route? | ");
            }
        };
    }

    /**
     * Throw Exception about Controller Method not founds
     */
    public static function classMethod($controller, $method)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("{$controller} does not respond to the {$method} action. | ");
    }

    /**
     * Throw Middleware not found
     */
    public static function middlewareNotDefined()
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("Middleware not found! did you forget to add it on http/kernel.php? | ");
    }

    /**
     * Throw PDO Error
     */
    public static function PDO_ERROR($e)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("{$e} | ");
    }

    /**
     * Throw Hash Algorithm not found
     */
    public static function hash($algo)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("There is no supported algo called {$algo} in this framework | ");
    }

    /**
     * Throw an error if key already exists inside the array
     */
    public static function keyExists($key, $array)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("Key {$key} already exist inside {$array}");
    }

    public static function routeNameNotExists($name)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("Named Route {$name} is not registered in the route! did you forgot to register it?");
    }

    public static function undefinedRelation($relation)
    {
        http_response_code(500);
        if (env('APP_DEBUG', true)) throw new Exception("Undefined {$relation}, did you forget to attach these property in Model?");
    }
}
