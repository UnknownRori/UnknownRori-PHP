<?php

namespace Core\Http;

interface IMiddleware
{
    public static function runAll(string $type);
    public static function run(array | string $middleware);
}
