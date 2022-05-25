<?php

namespace Core;

use Core\Http\Middleware;
use Core\Http\Route;
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
        set_exception_handler(function ($e) {
            view('error.error', [
                'e' => $e
            ]);
            Middleware::runAll('web');
            die;
        });
    }

    /**
     * Throw Exception about Route not defined
     */
    public static function routeNotDefined()
    {
        abort(404);
        if (env('APP_DEBUG', true)) {
            if(Route::$api) {
                return response()->json([ 'message' => 'There is no page to be displayed!' ], 404);
            }else {
                throw new Exception("Route is not defined, did you forget to register it in web route?");
            }
        }
    }

    /**
     * Throw Exception about Controller Method not founds
     */
    public static function classMethod($controller, $method)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("{$controller} does not respond to the {$method} action.");
    }

    /**
     * Throw Middleware not found
     */
    public static function middlewareNotDefined()
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("Middleware not found! did you forget to add it on http/kernel.php?");
    }

    /**
     * Throw PDO Error
     */
    public static function PDO_ERROR($e)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("{$e}");
    }

    /**
     * Throw Hash Algorithm not found
     */
    public static function hash($algo)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("There is no supported algo called {$algo} in this framework");
    }

    /**
     * Throw an error if key already exists inside the array
     */
    public static function keyExists($key, $array)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("Key {$key} already exist inside {$array}");
    }

    public static function routeNameNotExists($name)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("Named Route {$name} is not registered in the route! did you forgot to register it?");
    }

    public static function undefinedRelation($relation)
    {
        abort(500);
        if (env('APP_DEBUG', true)) throw new Exception("Undefined {$relation}, did you forget to attach these property in Model?");
    }
}
