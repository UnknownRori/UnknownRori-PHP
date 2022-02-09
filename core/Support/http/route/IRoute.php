<?php

namespace Core\Support\Http;

interface IRoute
{
    public static function define($configRoute);
    public static function get($uri, $controller);
    public static function post($uri, $controller);
    public static function delete($uri, $controller);
    public static function patch($uri, $controller);
    public function middleware($middleware);
    public static function GetRoute($name);
    public static function Redirect($name);
    public function Run($uri, $requestType);
    public function name($name);
}
