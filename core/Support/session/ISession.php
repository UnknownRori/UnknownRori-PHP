<?php

namespace Core\Support\Http;

interface ISession
{
    public static function Get($name);
    public static function Set($name, string | array | int $value);
    public static function Destroy();
    public static function Unset($name);
}
