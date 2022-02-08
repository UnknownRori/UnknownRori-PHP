<?php

namespace Core;

interface IAuth
{
    public static function User();
    public function get($key = null);
    public static function attempt($credentials);
    public static function check();
    public static function logout();
}
