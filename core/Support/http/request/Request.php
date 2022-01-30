<?php

namespace Core\Support\Http;

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

    public static function Request()
    {
        return $_REQUEST;
    }

    public static function Get()
    {
        return $_GET;
    }

    public static function Post()
    {
        return $_POST;
    }
}
