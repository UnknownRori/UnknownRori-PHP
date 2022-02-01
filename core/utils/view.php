<?php

/**
 * Render web page and also passing argument as variable for the web page
 */
function view($view, $data = [])
{
    extract($data);

    require("{$_ENV['APP_DIR']}/views/{$view}.php");
}
