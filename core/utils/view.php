<?php

use eftec\bladeone\BladeOne;

/**
 * Render web page and also passing argument as variable for the web page
 * Old view function
 */
// function view($view, $data = [])
// {
//     extract($data);

//     require("{$_ENV['APP_DIR']}/views/{$view}.php");
// }

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
    if (file_exists("{$_ENV['views']}/{$view}.blade.php")) {
        $blade = new BladeOne($_ENV['views'], $_ENV['cache'], BladeOne::MODE_DEBUG);

        echo $blade->run($view, $data);
    } else {
        extract($data);

        require("{$_ENV['views']}/{$view}.php");
    }
}
