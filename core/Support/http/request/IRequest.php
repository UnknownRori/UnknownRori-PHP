<?php

namespace Core\Support\Http;

interface IRequest
{
    public static function URI();
    public static function Method();
    public static function Request();
    public static function Get();
    public static function Post();
}
