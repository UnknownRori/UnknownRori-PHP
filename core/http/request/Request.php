<?php

namespace Core\Http\Request;

class Request implements IRequest
{
    public static function URI()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function Method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
