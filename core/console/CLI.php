<?php

namespace Core\Console;

use Core\Kernel;
use Exception;

class CLI
{
    protected static $argumments = [];
    public static $version = "2.0 Alpha \n";

    /**
     * Initialize CLI
     * @param array $argv Command Line Argumments
     * @return void
     */
    public static function Start($argv)
    {
        array_shift($argv);
        self::$argumments = $argv;
        if (!$argv) {
            echo "Welcome to the UnknownRori-PHP CLI\n";
            echo "type help for more information\n";
        } else {
            echo self::Command();
        }
    }

    public static function Command()
    {
        $app = new Kernel();
        $app->loadConfig();

        $make_warn = "Please add name to the";
        $list_command = " >> install \n >> serve \n >> autoload \n >> make:controller|model|middleware\n";

        if (self::$argumments[0] == "help") {
            echo $list_command;
        } else if (self::$argumments[0] == "version") {
            echo "UnknownRori-PHP " . self::$version;
        } else if (self::$argumments[0] == "serve") {
            echo "Starting UnknownRori PHP development server : http://127.0.0.1:8000. \n";
            echo (shell_exec("php -S 127.0.0.1:8000 -t ./public ./public/index.php"));
        } else if (self::$argumments[0] == "autoload") {
            echo (shell_exec("composer dump-autoload"));
        } else if (self::$argumments[0] == "cache:clear") {
            echo (shell_exec("php vendor/eftec/bladeone/lib/BladeOne.php -clearcompile -compilepath {$_ENV['view_cache']}"));
        } else if (self::$argumments[0] == "make:controller") { // Make:Controller
            if (count(self::$argumments) < 2) return "{$make_warn} controller";
            require('template/controller.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/http/controller/{$name}.php");
        } else if (self::$argumments[0] == "make:model") { // Make:Model
            if (count(self::$argumments) < 2) return "{$make_warn} model! \n";
            require('template/model.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/model/{$name}.php");
        } else if (self::$argumments[0] == "make:middleware") { // Make:Middleware
            if (count(self::$argumments) < 2) return "{$make_warn} middleware";
            require('template/middleware.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/http/middleware/{$name}.php");
        } else {
            echo $list_command;
        }
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
