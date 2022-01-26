<?php

namespace Core\Http\Middleware;

interface IMiddleware
{
    public static function Provide();
    public function Run($type);
    public function RunSingle($middleware);
}
