<?php

namespace Core\Support\Http;

class Session implements ISession
{

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
    public static function Set($name, string | array | int $value)
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
