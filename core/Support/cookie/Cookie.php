<?php

namespace Core\Support;

class Cookie implements ICookie
{

    /**
     * To check if the user enabled cookie
     * @return boolean
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
     * @return boolean
     */
    public static function set($name, $value, $time, $path = '/')
    {
        return setcookie($name, $value, $time, $path);
    }

    /**
     * Unset cookie
     * @return bool
     */
    public static function unset($name)
    {
        return setcookie($name, "", time() - 3600);
    }

    /**
     * Get cookie
     * @return mixed
     */
    public static function get($key = null)
    {
        if (!is_null($key)) return $_COOKIE[$key];
        return $_COOKIE;
    }

    /**
     * Destroy all cookie based storage
     * @return void
     */
    public static function destroy()
    {
        foreach (array_keys($_COOKIE) as $data) {
            setcookie($data, "", time() - 3600);
        }
    }
}
