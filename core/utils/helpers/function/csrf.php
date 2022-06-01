<?php

use Core\Http\CSRF;

/**
 * Generate hidden field contain csrf token
 * @return string
 */
function csrf()
{
    $token = session()->get(CSRF::$session);
    return "<input name='_csrf_token' value=" . $token ." hidden ></input>";
}

/**
 * Get csrf token
 * @return string
 */
function csrf_token()
{
    return session()->get(CSRF::$session);
}