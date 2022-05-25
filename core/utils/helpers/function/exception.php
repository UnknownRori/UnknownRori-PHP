<?php

function report($message = "")
{
    if (env('APP_DEBUG', true)) throw new Exception($message);
    return;
}

/**
 * Send out http response code
 *
 * Code     Status
 * 
 * 200      OK
 * 
 * 201      Created
 * 
 * 202      Accepted
 * 
 * 203      Non-Authoritative Information
 * 
 * 400      Bad Request
 * 
 * 404      Not Found
 * 
 * 500      Server Error
 */
function abort(int $code = 500) {
    http_response_code($code);
}