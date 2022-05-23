<?php

use Core\Support\Str\Str;

/**
 * Helper function to call Str Class
 * @return  \Core\Utils\Str
 */
function str($str)
{
    return new Str($str);
}
