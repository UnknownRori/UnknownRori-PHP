<?php

namespace Core\Support;

interface ISession
{
    public static function get($name);
    public static function set($name, string | array | int $value);
    public static function destroy();
    public static function unset($name);
}
