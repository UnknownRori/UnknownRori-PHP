<?php

namespace Core\Support;

interface ISession
{
    public static function get($key = null);
    public static function set($name, $value);
    public static function destroy();
    public static function unset($name);
}
