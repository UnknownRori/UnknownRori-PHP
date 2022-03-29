<?php

namespace Core\Support\Cache;

use Core\Support\Filesystem\File;
use Core\Utils\Json;
use Core\Utils\Time;

class Cache implements ICache
{

    protected $option;

    public function __construct()
    {
        $this->option = require "{$_ENV['APP_DIR']}/config/cache.php";
    }

    /**
     * Cache specific instruction alongside with the key and store it
     */
    public static function remember(string $key, int $time = 3600, callable $callback)
    {
        $self = new self;
        if ($self->option['type'] == "filesystem") {
            switch ($self->option['cache_type']) {
                case "json":
                    return $self->json($key, $time, $callback);
                    break;
            }
        }
    }

    private function json($key, $time, $callback)
    {
        $cache = new File("{$_ENV['cache']}/app/{$key}.json");
        if ($cache->time_modified() + $time > Time::now()) {
            return Json::Decode($cache->get());
        } else {
            $result = call_user_func($callback);
            $cache->write(Json::Encode($result));
            return $result;
        }
    }
}
