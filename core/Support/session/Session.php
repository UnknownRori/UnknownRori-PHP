<?php

namespace Core\Support\Http;

class Session implements ISession
{

    public static function Start($option = [])
    {
        return session_start($option);
    }

    /**
     * Get Session Data
     */
    public static function Get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * Set Session Data
     */
    public static function Set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Destroy Current Session
     */
    public static function Destroy()
    {
        return session_destroy();
    }

    /**
     * Unset Session Data
     */
    public static function Unset($name)
    {
        $_SESSION[$name] = null;
    }
}
