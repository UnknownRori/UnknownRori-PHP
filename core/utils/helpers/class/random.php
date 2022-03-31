<?php

namespace Core\Utils;

class Random
{
    /**
     * Generate a random integer
     * @param  int $min
     * @param  int $max
     * @return int
     */
    public static function rand(int $min = 0, int $max = 10): int
    {
        return rand($min, $max);
    }

    /**
     * Generates cryptographically secure pseudo-random bytes
     * @param  int $length
     * @return string
     */
    public static function byte(int $length = 10): string
    {
        return random_bytes($length);
    }

    /**
     * Generates cryptographically secure pseudo-random integers
     * @param   int $min
     * @param   int $max
     * @return  int
     */
    public static function int(int $min = 0, int $max = 10): int
    {
        return random_int($min, $max);
    }

    /**
     * Generates random string of character
     * @param  int    $length
     * @param  string $char
     * @return string
     */
    public static function char(int $length, string $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"): string
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result = $result . $char[self::int(0, strlen($char) - 1)];
        }
        return $result;
    }

    /**
     * Generates a string of pseudo-random bytes, with the number of bytes determined by the length parameter.
     * @param  int  $length
     * @param  bool $strong_result
     * @return string
     */
    public static function opensslrand(int $length, bool $strong_result = null): string
    {
        return openssl_random_pseudo_bytes($length, $strong_result);
    }
}
