<?php

namespace Core\Http;

use Core\Support\Validator\Validator;

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
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get all data from any method
     * @param  string $key
     * @return mixed
     */
    public static function all(string $key = null)
    {
        if (!is_null($key)) return $_REQUEST[$key];
        return $_REQUEST;
    }

    /**
     * Get all data from any method and then validate using `validator` class
     * @param  mixed $rules
     * @return mixed
     */
    public static function validate(mixed $rules)
    {
        return Validator::Validate(Request::all())->rules($rules);
    }

    /**
     * Return a list of request header from client
     * @return array
     */
    public static function headers()
    {
        $headers = [];
        $headersList = headers_list();

        for($i = 0; $i < count($headersList); $i++) {
            $explode = explode(':', $headersList[$i]);
            $headers[$explode[0]] = $explode[1];
        }

        return $headers;
    }

    /**
     * Get data on get method
     * @param  string $key
     * @return mixed
     */
    public static function get(string $key = null)
    {
        if (!is_null($key)) return $_GET[$key];
        return $_GET;
    }

    /**
     * Get data on post method
     * @param  string $key
     * @return mixed
     */
    public static function post(string $key = null)
    {
        if (!is_null($key)) return $_POST[$key];
        return $_POST;
    }

    /**
     * Get upload file
     * @param  string $key
     * @return file
     */
    public static function file(string $key = null)
    {
        if (!is_null($key)) return $_FILES[$key];
        return $_FILES;
    }
}
