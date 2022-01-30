<?php

namespace Core;

interface IModel
{
    public static function find($id);
    public static function all();
    public static function where($column, $value, $logic = '=');
    public static function paginate($perPage);
}
