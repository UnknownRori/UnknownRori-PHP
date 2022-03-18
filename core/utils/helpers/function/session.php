<?php

use Core\Support\Session;

/**
 * Helper class to initialize session instace
 * @param  string  $key
 * @param  mixed   $value
 * @return Core\Support\Session
 */
function session($key = null, $value = null)
{
    return new Session($key, $value);
}
