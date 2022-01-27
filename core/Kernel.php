<?php

namespace Core;

use Core\Http\Middleware\Middleware;
use Core\Http\Request\Request;
use Core\Http\Route\Route;
use Dotenv\Dotenv;

/**
 * Kernel of UnknownRori PHP Framework
 */
class Kernel implements IKernel
{
    /**
     * Starting point of the entire framework,
     * Request will be sent to this method and then to Route
     * @return Static|False
     */
    public static function Start($accessregex = "/\.(?:png|jpg|jpeg|gif|css|js|ico)$/")
    {
        $App = new static;
        $dotenv = Dotenv::createImmutable($_ENV['ROOT_PROJECT']);
        $dotenv->load();


        if (preg_match($accessregex, $_SERVER["REQUEST_URI"])) {
            return false;
        } else {
            Middleware::Provide()->Run('runtime');

            Route::define("{$_ENV['APP_DIR']}\\route\web.php")->Redirect(Request::URI(), Request::Method());

            Middleware::Provide()->Run('runtime');
        }

        return $App;
    }
}
