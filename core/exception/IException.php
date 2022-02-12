<?php

namespace Core;

interface IException
{
    public static function RouteNotDefined();
    public static function ClassMethod($controller, $method);
    public static function MiddlewareNotDefined();
    public static function PDO_ERROR($e);
    public static function Hash($algo);
}
