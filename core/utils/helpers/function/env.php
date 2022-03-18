<?php

/**
 * Gets the value of an environment variable.
 * @param string $key
 * @param mixed $default
 * 
 * @return mixed  
 */
function env($key, $default = null)
{
    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    }

    return $default;
}
