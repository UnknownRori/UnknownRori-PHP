<?php

namespace Core\Console;

use Core\Kernel;
use RuntimeException;
use UnknownRori\Console\Console;

class CLI
{
    public static function Start(array $argv): mixed
    {
        $console = new Console();
        $app = new Kernel();
        $app->loadConfig();
        $console->appVersion = $_ENV['APP_VERSION'];

        $console->appName = "Rori-PHP's CLI";
        $console->appDescription = "Rori-PHP Development CLI";

        $console->addCommand('version', "It show Framework's version", function () {
            echo "UnknownRori-PHP " . $_ENV['APP_VERSION'];
        });

        $console->addCommand('serve', "Run Development Server", function () {
            echo "\e[1mStarting UnknownRori PHP development server : \e[32mhttp://127.0.0.1:8000.\e[0m \n";
            echo (shell_exec("php -S 127.0.0.1:8000 -t ./public ./public/index.php"));
        });

        $console->addCommand('cache:clear', "Clear app cache", function () {
            echo (shell_exec("php vendor/eftec/bladeone/lib/BladeOne.php -clearcompile -compilepath {$_ENV['view_cache']}"));
        });

        $console->addCommand('make:controller', "Create a controller class", function (string $name, ?string $modelName = null) {
            self::createFromTemplate('Controller', '/http/controller', $name, $modelName);
        });

        $console->addFlag('make:controller', 'resource', "Create a resource controller class", Console::FLAG_OVERIDE, function (string $name, ?string $modelName = null) {
            self::createFromTemplate('ResourceController', '/http/controller', $name, $modelName);
        });

        $console->addCommand('make:model', "Create a model class", function (string $name) {
            self::createFromTemplate('Model', '/model', $name);
        });

        $console->addFlag('make:model', 'controller', "Create a controller class", Console::FLAG_AFTER, function (string $name) {
            self::createFromTemplate('Controller', '/http/controller', "{$name}Controller", $name);
        });

        $console->addFlag('make:model', 'resource', "Create a controller class", Console::FLAG_AFTER, function (string $name) {
            self::createFromTemplate('ResourceController', '/http/controller', "{$name}Controller", $name);
        });

        $console->addCommand('make:middleware', "Create a middleware class", function (string $name) {
            self::createFromTemplate('Middleware', '/http/middleware', $name);
        });

        return $console->serve($argv);
    }

    public static function createFromTemplate(string $name, string $path, ...$param)
    {
        require("template/{$name}.php");
        $action = "generate{$name}";
        if (!self::write($action($param[0], isset($param[1]) ? $param[1] : null), "{$path}/{$param[0]}.php"))
            throw new RuntimeException("Cannot generate template!");
        else
            shell_exec('composer dump-autoload');
    }

    /**
     * Create file in desired location using template provided inside console/template directory.
     * @param  mixed  $content
     * @param  string $Path
     */
    protected static function write($content, $Path): bool
    {
        $template = fopen("{$_ENV['APP_DIR']}/{$Path}", "w");

        if (is_bool($template))
            return false;

        $txt = "{$content}";
        fwrite($template, $txt);
        return fclose($template);
    }
}
