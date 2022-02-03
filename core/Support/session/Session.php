<?php

namespace Core\Support;

class Session implements ISession
{
    /**
     * Initialize Session data and should be used in Kernel.php,
     * this method can be passed with an array of option which can be modified in `app/config/kernel.php`
     */
    public static function start($option = [])
    {
        return session_start($option);
    }

    /**
     * Get Session Data
     */
    public static function get($key = null)
    {
        if (!is_null($key)) return $_SESSION;

        return $_SESSION;
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
