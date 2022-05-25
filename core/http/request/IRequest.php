<?php

namespace Core\Http;

interface IRequest
{
    public static function URI();
    public static function method();
    public static function all(string $key = null);
    public static function validate(mixed $rules);
    public static function headers();
    public static function get(string $key = null);
    public static function post(string $key = null);
    public static function file(string $key = null);
}
