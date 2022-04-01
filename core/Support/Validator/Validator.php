<?php

namespace Core\Support\Validator;

use Core\Utils\Regex;

class Validator
{
    private $data;

    private function __construct(array|string|int|bool $data)
    {
        $this->data = $data;
    }

    /**
     * Validate Data
     * @param  mixed $data
     * @return self
     */
    public static function Validate($data)
    {
        return new self($data);
    }

    /**
     * Validate the passed data using regular expression.
     * if it fail to validate it will return false but it's success it will return data that passed.
     * @param  array|string $rules
     * @return string|array|bool
     */
    public function regex(array|string $rules): string|int|bool|array
    {
        $key = array_keys($rules);

        if (is_null($key)) return Regex::occurance($this->data, $rules) ? $this->data : False;

        $valid = [];

        for ($i = 0; $i < count($rules); $i++) {
            if (!Regex::occurance($this->data[$key[$i]], $rules[$key[$i]])) return False;
            array_push($valid, Regex::occurance($this->data[$key[$i]], $rules[$key[$i]]));
        }

        return $valid ? $this->data : False;
    }

    /**
     * Validate the passed data using built in rule.
     * if it fail to validate it will return false but it's success it will return data that passed.
     * @param  array|string $rules
     * @return string|array|bool
     */
    public function rules(array $rules): string|int|bool|array
    {
        $rules_key = array_keys($rules);

        $valid = [];

        if (!is_array($this->data)) {
            for ($i = 0; $i < count($rules_key); $i++) {
                $explode = explode(":", $rules[$rules_key[$i]]);
                $function = $explode[0];
                array_push($valid, $this->$function(isset($explode[1]) ? $explode[1] : null));
            }
            if (in_array(false, $valid)) return False;
            return $this->data;
        }
        $data_key = array_keys($this->data);
        for ($i = 0; $i < count($data_key); $i++) {
            for ($j = 0; $j < count($rules[$rules_key[$i]]); $j++) {
                $explode = explode(":", $rules[$rules_key[$i]][$j]);
                $function = $explode[0];
                var_dump($rules[$rules_key[$i]][$j]);
                if (isset($explode[1])) array_push($valid, $this->$function(isset($explode[1]) ? $explode[1] : false, $data_key[$i]));
                else array_push($valid, $this->$function($data_key[$i]));
            }
        }
        if (in_array(false, $valid)) return False;
        return $this->data;
    }

    /**
     * /-------------------\
     * |Built in rules area|
     * \-------------------/
     */

    /**
     * Validate current pointer is a string or not
     * @param  string $offset
     * @return bool
     */
    private function string(string $offset = null): bool
    {
        if (is_null($offset)) return is_string($this->data);
        return is_string($this->data[$offset]);
    }

    /**
     * Validate current pointer is a boolean or not
     * @param  string $offset
     * @return bool
     */
    private function bool($offset = null): bool
    {
        if (is_null($offset)) return is_bool($this->data);
        return is_bool($this->data[$offset]);
    }

    /**
     * Validate current pointer is a numeric or not
     * @param  string $offset
     * @return bool
     */
    private function numeric($offset = null): bool
    {
        if (is_null($offset)) return is_numeric($this->data);
        return is_numeric($this->data[$offset]);
    }

    /**
     * Validate current pointer is an ip address or not
     * @param  string $offset
     * @return bool
     */
    private function ip($offset = null): bool
    {
        if (is_null($offset)) return filter_var($this->data, FILTER_VALIDATE_IP) ? True : False;
        return filter_var($this->data[$offset], FILTER_VALIDATE_IP) ? True : False;
    }

    /**
     * Validate current pointer is an email or not
     * @param  string $offset
     * @return bool
     */
    private function email($offset = null): bool
    {
        if (is_null($offset)) return filter_var($this->data, FILTER_VALIDATE_EMAIL) ? True : False;
        return filter_var($this->data[$offset], FILTER_VALIDATE_EMAIL) ? True : False;
    }

    /**
     * Validate current pointer is it have minimum character or total number
     * @param  int    $min
     * @param  string $offset
     * @return bool
     */
    private function min(int $min, $offset = null): bool
    {
        if (is_null($offset)) {
            if ($this->numeric()) return float($this->data) > $min ? True : False;
            elseif ($this->string()) return strlen($this->data) > $min ? True : False;
            return false;
        } else {
            if ($this->numeric($offset)) return float($this->data[$offset]) > $min ? True : False;
            elseif ($this->string($offset)) return strlen($this->data[$offset]) > $min ? True : False;
            return false;
        }
    }

    /**
     * Validate current pointer is it have maximum character or total number
     * @param  int    $min
     * @param  string $offset
     * @return bool
     */
    private function max(int $max, $offset = null)
    {
        if (is_null($offset)) {
            if ($this->numeric()) return float($this->data) > $max ? True : False;
            elseif ($this->string()) return strlen($this->data) > $max ? True : False;
            return false;
        } else {
            if ($this->numeric($offset)) return float($this->data[$offset]) > $max ? True : False;
            elseif ($this->string($offset)) return strlen($this->data[$offset]) > $max ? True : False;
            return false;
        }
        // if ($this->numeric()) return float($this->data) < $max ? True : False;
        // elseif ($this->string()) return strlen($this->data) < $max ? True : False;
        // return false;
    }
}
