<?php

use Core\Http\CSRF;

function csrf()
{
    $token = session()->get(CSRF::$session);
    return "<input name='_csrf_token' value=" . $token ." hidden ></input>";
}