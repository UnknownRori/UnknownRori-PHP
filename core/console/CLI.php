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
            self::createFromTemplate('controller', '/http/controller', $name);
        });

        $console->addFlag('make:controller', 'resource', "Create a controller class", Console::FLAG_OVERIDE, function (string $name) {
            self::createFromTemplate('resourcecontroller', '/http/controller', $name);
        });

        $console->addCommand('make:model', "Create a controller class", function (string $name) {
            self::createFromTemplate('model', '/model', $name);
        });

        // $console->addFlag('make:model', 'controller', "Create a controller class", Console::FLAG_AFTER, function (string $name) {
        //     self::createFromTemplate('resourcecontroller', '/http/controller', $name);
        // });

        $console->addCommand('make:middleware', "Create a controller class", function (string $name) {
            self::createFromTemplate('middleware', '/http/middleware', $name);
        });

        return $console->serve($argv);
    }

    public static function createFromTemplate(string $name, string $path, ...$param)
    {
        require("template/{$name}.php");
        if (!self::write(generate($param[0], isset($param[1]) ? $param[1] : null), "{$path}/{$param[0]}.php"))
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
