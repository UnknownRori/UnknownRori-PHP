<?php

namespace Core\Utils;

class Json
{

    /**
     * Encode the passed argumments to json
     * @param  mixed $data
     * @param  int   $flag
     * @param  int   $depth
     * @return string
     */
    public static function Encode(mixed $data, int $flag = 0, int $depth = 512)
    {
        return json_encode($data, $flag, $depth);
    }

    /**
     * Decode the passed json argumments
     * @param  mixed $data
     * @param  bool  $associative
     * @param  int   $flag
     * @param  int   $depth
     * @return mixed
     */
    public static function Decode(mixed $data, bool $associative = true, int $depth = 512, int $flag = 0)
    {
        return json_decode($data, $associative, $depth, $flag);
    }
}
