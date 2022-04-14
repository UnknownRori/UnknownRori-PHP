<?php

namespace Core\Support\Validator;

use Core\Support\Session;
use Core\Utils\Regex;

class Validator
{
    private $data;
    private $valid = [];
    public  $message = [];
    public static $session = "VALIDATE_MESSAGE";

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

        for ($i = 0; $i < count($rules); $i++) array_push($this->valid, Regex::occurance($this->data[$key[$i]], $rules[$key[$i]]) ? True : False);

        if (in_array(false, $this->valid)) return False;
        return $this->data;
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
                // if (!$result) return False;
                array_push($this->valid, $result);
            }
            Session::set(self::$session, $this->message);
            if (in_array(false, $this->valid)) return False;
            return $this->data;
        }

        $data = collect($this->data)->remove($rules_key);
        $this->data = collect($this->data)->remove(array_keys($data->get()))->get();
        $data_key = array_keys($this->data);

        array_map(function ($key) {
            $this->message[$key] = [];
        }, $rules_key);

        for ($i = 0; $i < count($rules); $i++) {
            for ($j = 0; $j < count($rules[$rules_key[$i]]); $j++) {
                $explode = explode(":", $rules[$rules_key[$i]][$j]);
                $function = $explode[0];
                if (isset($explode[1])) {
                    if (isset($data_key[$i])) {
                        $result = $this->$function(isset($explode[1]) ? $explode[1] : false, $data_key[$i]);
                        // if (!$result) return False;
                        array_push($this->valid, $result);
                    } else {
                        $this->setMessage("Cannot be empty!", $rules_key[$i]);
                    }
                } else {
                    if (isset($data_key[$i])) {
                        $result = $this->$function($data_key[$i]);
                        // if (!$result) return False;
                        array_push($this->valid, $result);
                    } else {
                        $this->setMessage("Cannot be empty!", $rules_key[$i]);
                    }
                };
            }
        }

        Session::set(self::$session, $this->message);
        if (in_array(false, $this->valid)) return False;
        return $this->data;
    }

    /**
     * Get all validation message or specific key
     * @param  string|int   $key
     * @return string|array
     */
    public static function GetMessage(string|int $key = null): string|array
    {
        if (!is_null($key)) return Session::get(self::$session)[$key];
        return Session::get(self::$session);
    }

    /**
     * Set validation message
     * @param  string     $message
     * @param  string|int $offset
     * @return void
     */
    private function setMessage($message, $offset = null): void
    {
        if (!in_array($message, $this->message[$offset])) {
            array_push($this->message[$offset], $message);
            array_push($this->valid, False);
        }
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
        if (is_null($offset)) {
            if (!is_string($this->data)) array_push($this->message, "Must be a string!");
            return is_string($this->data);
        }
        if (!is_string($this->data[$offset])) array_push($this->message[$offset], "Must be a string!");
        return is_string($this->data[$offset]);
    }

    /**
     * Validate current pointer is a boolean or not
     * @param  string|int $offset
     * @return bool
     */
    private function bool(string|int $offset = null): bool
    {
        if (is_null($offset)) {
            if (!is_bool($this->data)) array_push($this->message, "Must be a boolean!");
            return is_bool($this->data);
        }
        if (!is_bool($this->data[$offset])) array_push($this->message[$offset], "Must be boolean");
        return is_bool($this->data[$offset]);
    }

    /**
     * Validate current pointer is a numeric or not
     * @param  string|int $offset
     * @return bool
     */
    private function numeric(string|int $offset = null): bool
    {
        if (is_null($offset)) {
            if (!is_numeric($this->data)) array_push($this->message, "Must be a numeric!");
            return is_numeric($this->data);
        }
        if (!is_numeric($this->data[$offset])) array_push($this->message[$offset], "Must be numeric!");
        return is_numeric($this->data[$offset]);
    }

    /**
     * Validate current pointer is an ip address or not
     * @param  string|int $offset
     * @return bool
     */
    private function ip(string|int $offset = null): bool
    {
        if (is_null($offset)) {
            $result = filter_var($this->data, FILTER_VALIDATE_IP) ? True : False;
            if (!$result) array_push($this->message, "Must be valid ip address!");
            return $result;
        }
        $result = filter_var($this->data[$offset], FILTER_VALIDATE_IP) ? True : False;
        if (!$result) array_push($this->message[$offset], "Must be valid ip address!");
        return $result;
    }

    /**
     * Validate current pointer is an email or not
     * @param  string|int $offset
     * @return bool
     */
    private function email(string|int $offset = null): bool
    {
        if (is_null($offset)) {
            $result = filter_var($this->data, FILTER_VALIDATE_EMAIL) ? True : False;
            if (!$result) array_push($this->message, "Must be valid email address!");
            return $result;
        }
        $result = filter_var($this->data[$offset], FILTER_VALIDATE_EMAIL) ? True : False;
        if (!$result) array_push($this->message[$offset], "Must be valid email address!");
        return $result;
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
            if (is_numeric($this->data)) {
                $result = float($this->data) > $min ? True : False;
                if (!$result) array_push($this->message, "Must be above {$min}");
                return $result;
            } elseif (is_string($this->data)) {
                $result = strlen($this->data) > $min ? True : False;
                if (!$result) array_push($this->message, $min > 1 ? "Must be above {$min} characters" : "Must be above {$min} character");
                return $result;
            }
            return false;
        } else {
            if (is_numeric($this->data[$offset])) {
                $result = float($this->data[$offset]) > $min ? True : False;
                if (!$result) array_push($this->message[$offset], "Must be above {$min}");
                return $result;
            } elseif (is_string($this->data[$offset])) {
                $result = strlen($this->data[$offset]) > $min ? True : False;
                if (!$result) array_push($this->message[$offset], $min > 1 ? "Must be above {$min} characters" : "Must be above {$min} character");
                return $result;
            }
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
            if (is_numeric($this->data)) {
                $result = float($this->data) < $max ? True : False;
                if (!$result) array_push($this->message, "Must be above {$max}");
                return $result;
            } elseif (is_string($this->data)) {
                $result = strlen($this->data) < $max ? True : False;
                if (!$result) array_push($this->message, $max > 1 ? "Must be below {$max} characters" : "Must be below {$max} character");
                return $result;
            }
        } else {
            if (is_numeric($this->data[$offset])) {
                $result = float($this->data[$offset]) < $max ? True : False;
                if (!$result) array_push($this->message[$offset], "Must be below {$max}");
                return $result;
            } elseif (is_string($this->data[$offset])) {
                $result = strlen($this->data[$offset]) < $max ? True : False;
                if (!$result) array_push($this->message[$offset], $max > 1 ? "Must be below {$max} characters" : "Must be below {$max} character");
                return $result;
            }
            return false;
        }
    }
}
