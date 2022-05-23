<?php

namespace Core\Support\Cache;

use Core\Support\Filesystem\File;
use Core\Utils\Json;
use Core\Utils\Time;

class Cache implements ICache
{

    protected $option;

    private function __construct()
    {
        $this->option = require "{$_ENV['APP_DIR']}/config/cache.php";
    }

    /**
     * Cache resulted data in passed function with expiration timer in second
     * @param  string   $key
     * @param  int      $time
     * @param  callable $callback
     * @return mixed
     */
    public static function remember(string $key, int $time, callable $callback): mixed
    {
        $self = new self;
        if ($self->option['type'] == "filesystem") {
            switch ($self->option['cache_type']) {
                case "json":
                    $cache = new File("{$_ENV['cache']}/app/{$key}.json");
                    if ($cache->modified() + $time > Time::now()) {
                        return Json::Decode($cache->get(), true);
                    } else {
                        $result = call_user_func($callback);
                        $cache->write(Json::Encode($result));
                        return $result;
                    }
                    break;
            }
        }
    }

    /**
     * Cache resulted data in passed function forever
     * @param  string   $key
     * @param  callable $callback
     * @return mixed
     */
    public static function rememberForever(string $key, callable $callback): mixed
    {
        $self = new self;
        if ($self->option['type'] == "filesystem") {
            switch ($self->option['cache_type']) {
                case "json":
                    $cache = new File("{$_ENV['cache']}/app/{$key}.json");
                    if ($cache->modified()) return Json::Decode($cache->get());
                    $result = call_user_func($callback);
                    $cache->write(Json::Encode($result));
                    return $result;
                    break;
            }
        }
    }
}
