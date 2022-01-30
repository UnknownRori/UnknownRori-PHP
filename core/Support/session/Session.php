<?php

namespace Core\Support;

class Session implements ISession
{

    public static function start($option = [])
    {
        return session_start($option);
    }

    /**
     * Get Session Data
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * Set Session Data
     */
    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Destroy Current Session
     */
    public static function destroy()
    {
        return session_destroy();
    }

    /**
     * Unset Session Data
     */
    public static function unset($name)
    {
        $_SESSION[$name] = null;
    }
}
