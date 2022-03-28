<?php

namespace Core\Http;

interface IMiddleware
{
    public static function RunAll(string $type);
    public static function Run(array | string $middleware);
}
