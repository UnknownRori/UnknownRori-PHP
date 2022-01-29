<?php

namespace Core\Support\Http;

class Cookie implements ICookie
{

    /**
     * To check if the user enabled cookie
     */
    public static function check()
    {
        setcookie('COOKIE:CHECK', 'lorem ipsum', time() + 10);
        if (count($_COOKIE) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set cookie
     */
    public static function set($name, $value, $time, $path = '/')
    {
        return setcookie($name, $value, $time, $path);
    }

    /**
     * Unset cookie
     */
    public static function unset($name)
    {
        return setcookie($name, "", time() - 3600);
    }

    /**
     * Get cookie
     */
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    /**
     * Destroy all cookie based storage
     */
    public static function destroy()
    {
        foreach (array_keys($_COOKIE) as $data) {
            setcookie($data, "", time() - 3600);
        }
    }
}
