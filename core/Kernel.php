<?php

namespace Core;

use Core\Http\CSRF;
use Core\Http\Middleware;
use Core\Http\Route;
use Core\Http\Request;
use Core\Support\Session;
use Dotenv\Dotenv;

/**
 * Kernel of UnknownRori PHP Framework
 */
class Kernel implements IKernel
{
    protected $option = [];

    public function __construct()
    {
        $this->option = require("{$_ENV['APP_DIR']}/config/kernel.php");
    }

    /**
     * Starting point of the entire framework,
     * Request will be sent to this method and then to Route
     * @return Static|False
     */
    public static function Start()
    {
        KernelException::init();

        $App = new static;

        $App->loadEnv();
        $App->loadConfig();
        $App->loadAuth();

        Session::start($App->option['session']);

        CSRF::init();

        $uri = Request::URI();
        $result = explode('/', $uri);
        
        if (preg_match($App->option['regex'], $_SERVER["REQUEST_URI"])) {
            return false;
        } else if($result[0] == 'api') {
            Middleware::runAll('api');
            
            Route::defineApi("{$_ENV['APP_DIR']}/route/api.php")->Run("/" . Request::URI(), Request::Method());

            Middleware::runAll('api');
        } else {
            Middleware::runAll('web');

            Route::defineWeb("{$_ENV['APP_DIR']}/route/web.php")->Run("/" . Request::URI(), Request::Method());

            Middleware::runAll('web');
        }

        return $App;
    }

    public function loadEnv()
    {
        if (file_exists($_ENV['ROOT_PROJECT'] . '/.env')) {
            Dotenv::createImmutable($_ENV['ROOT_PROJECT'])->load();
        }
    }

    public function loadConfig()
    {
        array_filter($this->option['ENV'], function ($value, $key) {
            $_ENV[$key] = $value;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function loadAuth()
    {
        return new Auth();
    }
}
