<?php

namespace Core\Support\Http;

class Request implements IRequest
{

    /**
     * Get current uri
     * @return string
     */
    public static function URI()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * Get current uri method
     * @return string
     */
    public static function Method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get all data from any method
     * @param  string $key
     * @return mixed
     */
    public static function Request($key = null)
    {
        if (!is_null($key)) return $_REQUEST[$key];
        return $_REQUEST;
    }

    /**
     * Get data on get method
     * @param  string $key
     * @return mixed
     */
    public static function Get($key = null)
    {
        if (!is_null($key)) return $_GET[$key];
        return $_GET;
    }

    /**
     * Get data on post method
     * @param  string $key
     * @return mixed
     */
    public static function Post($key = null)
    {
        if (!is_null($key)) return $_POST[$key];
        return $_POST;
    }

    /**
     * Get upload file
     * @param  string $key
     * @return file
     */
    public static function File($key = null)
    {
        if (!is_null($key)) return $_FILES[$key];
        return $_FILES;
    }
}
