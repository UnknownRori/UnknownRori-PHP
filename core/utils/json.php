<?php

namespace Core\Utils;

class Json
{

    /**
     * Encode the passed argumments to json
     * @param  mixed $data
     * @return string
     */
    public static function Encode(mixed $data)
    {
        return json_encode($data);
    }

    /**
     * Decode the passed json argumments
     * @param  mixed $data
     * @return mixed
     */
    public static function Decode(mixed $data)
    {
        return json_decode($data);
    }
}
