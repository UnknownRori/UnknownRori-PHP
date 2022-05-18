<?php

namespace Core;

interface IException
{
    public static function init();
    public static function routeNotDefined();
    public static function classMethod($controller, $method);
    public static function middlewareNotDefined();
    public static function PDO_ERROR($e);
    public static function hash($algo);
    public static function keyExists($key, $array);
    public static function routeNameNotExists($name);
    public static function undefinedRelation($relation);
}
