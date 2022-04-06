<?php

namespace Core\Support\Validator;

use Core\Utils\Regex;

class Validator
{
    private $data;
    private $valid = [];

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
        if (!is_array($rules)) return Regex::occurance($this->data, $rules) ? $this->data : False;

        $key = array_keys($rules);
        $data = collect($this->data)->remove($key);
        $this->data = collect($this->data)->remove(array_keys($data->get()))->get();

        for ($i = 0; $i < count($rules); $i++) {
            if (!Regex::occurance($this->data[$key[$i]], $rules[$key[$i]])) return False;
            array_push($this->valid, Regex::occurance($this->data[$key[$i]], $rules[$key[$i]]));
        }

        return $this->valid ? $this->data : False;
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

        if (!is_array($this->data)) {
            for ($i = 0; $i < count($rules_key); $i++) {
                $explode = explode(":", $rules[$rules_key[$i]]);
                $function = $explode[0];

                $result = $this->$function(isset($explode[1]) ? $explode[1] : null);
                if (!$result) return False;
                array_push($this->valid, $result);
            }
            if (in_array(false, $this->valid)) return False;
            return $this->data;
        }

        $data = collect($this->data)->remove($rules_key);
        $this->data = collect($this->data)->remove(array_keys($data->get()))->get();
        $data_key = array_keys($this->data);

        for ($i = 0; $i < count($rules); $i++) {
            for ($j = 0; $j < count($rules[$rules_key[$i]]); $j++) {
                $explode = explode(":", $rules[$rules_key[$i]][$j]);
                $function = $explode[0];
                if (isset($explode[1])) {
                    $result = $this->$function(isset($explode[1]) ? $explode[1] : false, $data_key[$i]);
                    if (!$result) return False;
                    array_push($this->valid, $result);
                } else {
                    $result = $this->$function($data_key[$i]);
                    if (!$result) return False;
                    array_push($this->valid, $result);
                };
            }
        }

        if (in_array(false, $this->valid)) return False;
        return $this->data;
    }

    /**
     * /----------------------\
     * |Built in rules section|
     * \----------------------/
     */

    /**
     * Validate current pointer is a string or not
     * @param  string|int $offset
     * @return bool
     */
    private function string(string|int $offset = null): bool
    {
        if (is_null($offset)) return is_string($this->data);
        return is_string($this->data[$offset]);
    }

    /**
     * Validate current pointer is a boolean or not
     * @param  string|int $offset
     * @return bool
     */
    private function bool(string|int $offset = null): bool
    {
        if (is_null($offset)) return is_bool($this->data);
        return is_bool($this->data[$offset]);
    }

    /**
     * Validate current pointer is a numeric or not
     * @param  string|int $offset
     * @return bool
     */
    private function numeric(string|int $offset = null): bool
    {
        if (is_null($offset)) return is_numeric($this->data);
        return is_numeric($this->data[$offset]);
    }

    /**
     * Validate current pointer is an ip address or not
     * @param  string|int $offset
     * @return bool
     */
    private function ip(string|int $offset = null): bool
    {
        if (is_null($offset)) return filter_var($this->data, FILTER_VALIDATE_IP) ? True : False;
        return filter_var($this->data[$offset], FILTER_VALIDATE_IP) ? True : False;
    }

    /**
     * Validate current pointer is an email or not
     * @param  string|int $offset
     * @return bool
     */
    private function email(string|int $offset = null): bool
    {
        if (is_null($offset)) return filter_var($this->data, FILTER_VALIDATE_EMAIL) ? True : False;
        return filter_var($this->data[$offset], FILTER_VALIDATE_EMAIL) ? True : False;
    }

    /**
     * Validate current pointer is it have minimum character or total number
     * @param  int    $min
     * @param  string|int $offset
     * @return bool
     */
    private function min(int $min, string|int $offset = null): bool
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
     * @param  string|int $offset
     * @return bool
     */
    private function max(int $max, string|int $offset = null)
    {
        if (is_null($offset)) {
            if ($this->numeric()) return float($this->data) < $max ? True : False;
            elseif ($this->string()) return strlen($this->data) < $max ? True : False;
            return false;
        } else {
            if ($this->numeric($offset)) return float($this->data[$offset]) < $max ? True : False;
            elseif ($this->string($offset)) return strlen($this->data[$offset]) < $max ? True : False;
            return false;
        }
    }
}
