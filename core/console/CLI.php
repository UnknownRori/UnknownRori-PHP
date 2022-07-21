<?php

namespace Core\Console;

use Core\Kernel;
use UnknownRori\Console\Console;

class CLI
{
    public static function Start(array $argv): mixed
    {
        $console = new Console();
        $app = new Kernel();
        $app->loadConfig();

        $console->appName = "Rori-PHP's CLI";
        $console->appDescription = "Rori-PHP Development CLI";

        $console->addCommand('version', "It show CLI's version", function () {
            echo "UnknownRori-PHP " . $_ENV['APP_VERSION'];
        });

        $console->addCommand('serve', "Run Development Server", function () {
            echo "\e[1mStarting UnknownRori PHP development server : \e[32mhttp://127.0.0.1:8000.\e[0m \n";
            echo (shell_exec("php -S 127.0.0.1:8000 -t ./public ./public/index.php"));
        });

        $console->addCommand('cache:clear', "Clear app cache", function () {
            echo (shell_exec("php vendor/eftec/bladeone/lib/BladeOne.php -clearcompile -compilepath {$_ENV['view_cache']}"));
        });

        $console->addCommand('make:controller', "Create a controller class", function (string $name) {
            require('template/resourcecontroller.php');
            self::write(controller($name), "/http/controller/{$name}.php");
        });

        $console->addCommand('make:controller', "Create a controller class", function (string $name) {
            require('template/controller.php');
            self::write(controller($name), "/http/controller/{$name}.php");
        });

        $console->addFlag('make:controller', 'resource', "Create a controller class", Console::FLAG_OVERIDE, function (string $name) {
            require('template/resourcecontroller.php');
            self::write(controller($name), "/http/controller/{$name}.php");
        });

        $console->addCommand('make:model', "Create a controller class", function (string $name) {
            require('template/model.php');
            self::write(controller($name), "/model/{$name}.php");
        });

        $console->addFlag('make:model', 'controller', "Create a controller class", Console::FLAG_AFTER, function (string $name) {
            require('template/resourcecontroller.php');
            self::write(controller($name), "/http/controller/{$name}.php");
        });

        $console->addCommand('make:middleware', "Create a controller class", function (string $name) {
            require('template/middleware.php');
            self::write(controller($name), "/http/middleware/{$name}.php");
        });

        return $console->serve($argv);
    }

    /**
     * Create file in desired location using template provided inside console/template directory.
     * @param  mixed  $content
     * @param  string $Path
     */
    protected static function write($content, $Path)
    {
        $template = fopen("{$_ENV['APP_DIR']}/{$Path}", "w");
        $txt = "{$content}";
        fwrite($template, $txt);
        fclose($template);
        echo (shell_exec("composer dump-autoload"));
    }
}
