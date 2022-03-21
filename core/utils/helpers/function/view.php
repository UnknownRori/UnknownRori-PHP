<?php

use Core\Auth;
use eftec\bladeone\BladeOne;

/**
 * Render a web page and also passing argument as variable for the web page,
 * Support BladeOne thanks to the eftec\bladeone\BladeOne class,
 * Documentation for [BladeOne](https://github.com/EFTEC/BladeOne#usage).
 * @param  string $view
 * @param  array  $data
 * @return void
 */
function view($view, $data = [])
{
    $filepath = str_replace(".", "/", $view);
    if (file_exists("{$_ENV['views']}/{$filepath}.blade.php")){
        $blade = new BladeOne($_ENV['views'], $_ENV['view_cache'], BladeOne::MODE_DEBUG);

        if (Auth::check()) {
            $blade->setAuth(Auth::User()->get(Auth::$option['unique_key']));
        }

        // $blade->pipeEnable = true;
        echo $blade->run($view, $data);
    } else {
        extract($data);

        require("{$_ENV['views']}/{$filepath}.php");
    }
}
