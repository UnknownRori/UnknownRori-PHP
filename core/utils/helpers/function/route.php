<?php

use Core\Http\Route;

/**
 * Redirect to passed named uri
 * @param  string $name
 * @param  array $data
 * @return void
 */
function redirect($name, $data = [])
{
    return Route::Redirect($name, $data);
}

/**
 * Return Named URI
 * @param  string $name
 * @param  array $data
 * @return string
 */
function route($name, $data = [])
{
    return Route::GetRoute($name, $data);
}
