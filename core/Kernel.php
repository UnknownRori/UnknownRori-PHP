<?php

namespace Core;

use Core\Support\Http\Middleware;
use Core\Support\Http\Route;
use Core\Support\Http\Request;
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

        Dotenv::createImmutable($_ENV['ROOT_PROJECT'])->load();

        if (preg_match($accessregex, $_SERVER["REQUEST_URI"])) {
            return false;
        } else {
            Middleware::Run('runtime');

            Route::define("{$_ENV['APP_DIR']}\\route\web.php")->Run("/" . Request::URI(), Request::Method());

            Middleware::Run('runtime');
        }

        return $App;
    }
}
