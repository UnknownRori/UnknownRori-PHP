<?php

namespace Core\Support\Cache;

interface ICache
{
    public static function remember(string $key, int $time, callable $callback): mixed;
    public static function rememberForever(string $key, callable $callback): mixed;
}
