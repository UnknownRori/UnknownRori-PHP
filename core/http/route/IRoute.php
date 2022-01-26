<?php

namespace Core\Http\Route;

interface IRoute
{
    public static function define($configRoute);
    public function get($uri, $controller);
    public function post($uri, $controller);
    // public function resource($uri, $controller);
    public function Redirect($uri, $requestType);
    public function middleware($middleware);
}
