<?php

namespace Core\Support\Http;

interface ICookie
{
    public static function check();
    public static function set($name, $value, $time, $path = '/');
    public static function unset($name);
    public static function get($name);
    public static function destroy();
}
