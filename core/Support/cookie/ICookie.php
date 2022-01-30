<?php

namespace Core\Support;

interface ICookie
{
    public static function check();
    public static function set($name, $value, $time, $path = '/');
    public static function unset($name);
    public static function get($name);
    public static function destroy();
}
