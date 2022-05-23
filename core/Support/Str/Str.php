<?php

namespace Core\Support\Str;

class Str implements IStr
{
    protected $data;

    /**
     * initialize UnknownRori\Str\Str Instance
     * @param  string $string
     * @return $this
     */
    public function __construct($string)
    {
        $this->data = $string;
        return $this;
    }

    /**
     * Uppercase string
     * @return string
     */
    public function upper()
    {
        return $this->data = strtoupper($this->data);
    }

    /**
     * Split the string into an array
     * @param  int   $length
     * @return array
     */
    public function split($length = 100)
    {
        return $this->data = str_split($this->data, $length);
    }

    /**
     * Explode the string into array
     * @param  string  $seperator
     * @return array
     */
    public function explode($seperator)
    {
        return $this->data = explode($seperator, $this->data);
    }

    /**
     * Trim the string
     * @param  string $string
     * @return $this
     */
    public function ltrim($string)
    {
        return $this->data = ltrim($this->data, $string);
    }

    /**
     * Uppercase the every first word
     * @return string
     */
    public function upperFirst()
    {
        return $this->data = ucfirst($this->data);
    }

    /**
     * Uppercase the first word
     * @return string
     */
    public function upperFirstWord()
    {
        return $this->data = ucwords($this->data);
    }

    /**
     * Count word inside a string
     * @return int
     */
    public function count()
    {
        return str_word_count($this->data);
    }

    /**
     * Count the length of the string
     * @return int
     */
    public function length()
    {
        return strlen($this->data);
    }

    /**
     * Lowercase the string
     * @return string
     */
    public function lower()
    {
        return $this->data = strtolower($this->data);
    }

    /**
     * Get the string
     * @return string
     */
    public function get()
    {
        return $this->data;
    }

    /**
     * Return Part of the string
     * @param  int $offset
     * @param  int $length
     * @return string
     */
    public function substr(int $offset, int $length)
    {
        return $this->data = substr($this->data, $offset, $length);
    }
}
