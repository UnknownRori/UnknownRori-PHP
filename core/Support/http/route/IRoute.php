<?php

namespace Core\Support\Http;

interface IRoute
{
    public static function define($configRoute);
    public function get($uri, $controller);
    public function post($uri, $controller);
    public function delete($uri, $controller);
    public function patch($uri, $controller);
    public function Run($uri, $requestType);
    public function middleware($middleware);
}
