<?php

namespace Core\Exception;

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
        return throw new Exception("Route is not defined, did you forget to register it in web route? | ");
    }

    /**
     * Throw Exception about Controller Method not founds
     */
    public static function ClassMethod($controller, $method)
    {
        return throw new Exception("{$controller} does not respond to the {$method} action. | ");
    }

    public static function MiddlewareNotDefined()
    {
        throw new Exception("Middleware not found! did you forget to add it on http/kernel.php? | ");
    }

    public static function PDO_ERROR($e)
    {
        throw new Exception($e);
    }
}
