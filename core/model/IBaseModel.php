<?php

namespace Core;

interface IBaseModel
{
    public static function find($id, $relation = null);
    public static function all($relation = null);
    public static function create(array $data);
    public static function destroy($id);
    public static function where($column, $value, $logic = '=');
    public static function paginate($perPage);
}
