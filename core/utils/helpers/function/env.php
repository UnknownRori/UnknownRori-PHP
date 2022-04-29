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

        switch (strtolower($_ENV[$key])) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        return $_ENV[$key];
    }

    return $default;
}
