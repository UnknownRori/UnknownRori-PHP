<?php

namespace Core\Support;

class Session implements ISession
{
    /**
     * Create Session Instance
     * @return  $this;
     */
    public function __construct($key = null, $value = null)
    {
        if($key && is_null($value)) return Session::get($key);
        if($key && $value) return Session::set($key, $value);
        return $this;
    }

    /**
     * Initialize Session data and should be used in Kernel.php,
     * this method can be passed with an array of option which can be modified in `app/config/kernel.php`
     * @return boolean
     */
    public static function start($option = [])
    {
        return session_start($option);
    }

    /**
     * Get Session Data
     * @param  string $key
     * @return mixed
     */
    public static function get($key = null)
    {
        if (is_null($key)) return $_SESSION;
        if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];
    }

    /**
     * Set Session Data
     * @param  string $name
     * @param  string $value
     * @return void
     */
    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Destroy Current Session
     * @return boolean
     */
    public static function destroy()
    {
        return session_destroy();
    }

    /**
     * Unset Session Data
     * @return void
     */
    public static function unset($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     * Check the data inside the session if exist return true if doesn't exist return false
     * @return boolean
     */
    public static function check($name)
    {
        if (array_key_exists($name, Session::get())) return true;
        return false;
    }
}
