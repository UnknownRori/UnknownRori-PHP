<?php

namespace Core\Utils;

class Regex
{
    /**
     * Perform regex and return back the value if it fail it will return false
     * @param  string $subject
     * @param  string $patern
     * @param  int    $flag
     * @param  int    $offset
     * @return array|bool
     */
    public static function occurance(string $subject, string $pattern, int $flag = PREG_SET_ORDER, int $offset = 0): array|bool
    {
        preg_match_all($pattern, $subject, $matches, $flag, $offset);
        return $matches ? $matches : false;
    }
}
