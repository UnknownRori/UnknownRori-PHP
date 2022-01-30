<?php

namespace Core\Console;

use Exception;

class CLI
{
    protected static $argumments = [];

    public static function Start($argv)
    {
        array_shift($argv);
        self::$argumments = $argv;
        self::Command();
    }

    public static function Command()
    {
        /**
         * php cli [command] [type] [name]  | php cli make controller CatController
         * php cli [command] [type]         | php cli help make
         * php cli [command]                | php cli install
         * [command] [type] [name]
         *      ^
         */
        if (self::$argumments[0] == "help") {
            echo " >> install \n >> serve \n >> autoload \n >> make:controller|model|middleware\n";
        } else if (self::$argumments[0] == "serve") {
            echo (shell_exec("php -S localhost:8080 -t ./public ./public/index.php"));
        } else if (self::$argumments[0] == "autoload") {
            echo (shell_exec("composer dump-autoload"));
        } else if (self::$argumments[0] == "install") {
            echo (shell_exec("composer install"));
            echo (shell_exec("composer dump-autoload"));
        } else if (self::$argumments[0] == "make:controller") { // Make:Controller
            if (count(self::$argumments) < 2) return;
            require('template/controller.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/http/controller/{$name}.php");
        } else if (self::$argumments[0] == "make:model") { // Make:Model
            if (count(self::$argumments) < 2) return;
            require('template/model.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/model/{$name}.php");
        } else if (self::$argumments[0] == "make:middleware") { // Make:Middleware
            if (count(self::$argumments) < 2) return;
            require('template/middleware.php');
            $name = self::$argumments[1];
            self::write(controller($name), "/http/middleware/{$name}.php");
        }
    }

    protected static function write($content, $appPath)
    {
        $template = fopen("{$_ENV['APP_DIR']}/{$appPath}", "w");
        $txt = "{$content}";
        fwrite($template, $txt);
        fclose($template);
    }
}
