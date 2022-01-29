<?php

namespace Core\Utils;

class Time
{
    public static function Seconds($seconds = 1)
    {
        return time() + (1 * $seconds);
    }

    public static function Hours($hours = 1)
    {
        return time() + (3600 * $hours);
    }

    public static function Days($days = 1)
    {
        return time() + (3600 * 24) * $days;
    }
}
