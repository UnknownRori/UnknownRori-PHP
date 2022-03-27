<?php

namespace Core\Utils;

class Time
{

    /**
     * Initialize Time helper class instance
     * @return  $this;
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * Return unix timestamp added or reduced by passed parameter
     * @param  int $days
     * @return int
     */
    public static function Seconds($seconds = 1)
    {
        return time() + (1 * $seconds);
    }

    /**
     * Return unix timestamp added or reduced by passed parameter
     * @param  int $days
     * @return int
     */
    public static function Hours($hours = 1)
    {
        return time() + (3600 * $hours);
    }

    /**
     * Return unix timestamp added or reduced by passed parameter
     * @param  int $days
     * @return int
     */
    public static function Days($days = 1)
    {
        return time() + (3600 * 24) * $days;
    }

    /**
     * Return current unix timestamp
     * @return  int
     */
    public static function now()
    {
        return time();
    }

    /**
     * Return current unix timestamp in microsecond
     * @param  bool $float
     * @return string|float
     */
    public static function microtime(bool $float = false)
    {
        return microtime($float);
    }

    /**
     * Format passed unix timestamp
     * @param  string|int  $time
     * @param  string      $format "F j, Y, g:i a"
     * @return string
     */
    public static function format($time, $format = "F j, Y, g:i a")
    {
        return date($format, $time);
    }
}
