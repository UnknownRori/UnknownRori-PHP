<?php

namespace Core;

use Core\Support\Http\Middleware;
use Core\Support\Http\Route;
use Core\Support\Http\Request;
use Core\Support\Session;
use Dotenv\Dotenv;
use Exception;

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
        $App = new static;

        $App->loadEnv();
        $App->loadConfig();

        set_exception_handler(function ($e) {
            echo "<pre style='{$_ENV["ERROR_STYLE"]}'>";
            throw new Exception($e);
            echo '</pre>';
            die;
        });

        Session::start($App->option['session']);

        if (preg_match($App->option['regex'], $_SERVER["REQUEST_URI"])) {
            return false;
        } else {
            Middleware::RunAll('runtime');

            Route::define("{$_ENV['APP_DIR']}/route/web.php")->Run("/" . Request::URI(), Request::Method());

            Middleware::RunAll('runtime');
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
}
