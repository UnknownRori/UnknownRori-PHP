<?php

namespace Core;

use Exception;

/**
 * Handle kernel exception
 */
class KernelException implements IException
{
    /**
     * Throw Exception about Route not defined
     */
    public static function RouteNotDefined()
    {
        throw new Exception("Route is not defined, did you forget to register it in web route? | ");
    }

    /**
     * Throw Exception about Controller Method not founds
     */
    public static function ClassMethod($controller, $method)
    {
        throw new Exception("{$controller} does not respond to the {$method} action. | ");
    }

    /**
     * Throw Middleware not found
     */
    public static function MiddlewareNotDefined()
    {
        throw new Exception("Middleware not found! did you forget to add it on http/kernel.php? | ");
    }

    /**
     * Throw PDO Error
     */
    public static function PDO_ERROR($e)
    {
        throw new Exception("{$e} | ");
    }

    /**
     * Throw Hash Algorithm not found
     */
    public static function Hash($algo)
    {
        throw new Exception("There is no supported algo called {$algo} in this framework | ");
    }

    /**
     * Throw an error if key already exists inside the array
     */
    public static function KeyExists($key, $array)
    {
        throw new Exception("Key {$key} already exist inside {$array}");
    }
}
