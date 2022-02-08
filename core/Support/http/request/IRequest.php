<?php

namespace Core\Support\Http;

interface IRequest
{
    public static function URI();
    public static function Method();
    public static function Request($key = null);
    public static function Get($key = null);
    public static function Post($key = null);
    public static function File($key = null);
}
