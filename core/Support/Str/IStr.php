<?php

namespace Core\Support\Str;

interface IStr
{
    public function upper();
    public function split($length = 100);
    public function explode($seperator);
    public function ltrim($string);
    public function upperfirst();
    public function upperfirstword();
    public function count();
    public function length();
    public function lower();
    public function get();
    public function substr(int $offset, int $length);
}