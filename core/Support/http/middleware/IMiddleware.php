<?php

namespace Core\Support\Http;

interface IMiddleware
{
    public static function Run(string $type);
    public static function RunSingle(array | string $middleware);
}
