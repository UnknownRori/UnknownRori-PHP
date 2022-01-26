<?php

/**
 * Your typical Die and Dump in Laravel, but different
 */
function dd(...$arguments)
{
    echo '<pre>';
    var_dump(...$arguments);
    echo '</pre>';
    die;
}
