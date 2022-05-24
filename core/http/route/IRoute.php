<?php

namespace Core\Http;

interface IRoute
{
    public static function defineWeb(string $configRoute): self;
    public static function defineApi(string $configRoute): self;
    public static function get(string $uri, callable|array $controller): self;
    public static function post(string $uri, callable|array $controller): self;
    public static function delete(string $uri, callable|array $controller): self;
    public static function patch(string $uri, callable|array $controller): self;
    public function middleware(string|array $middleware): self;
    public static function middlewares(string|array $middleware): self;
    public function name(string $name): self;
    public static function names(string $name): self;
    public static function prefix(string $uri): self;
    public static function GetRoute($name, $data): string;
    public static function Redirect($name, $data);
    public function Run($uri, $requestType);
}
