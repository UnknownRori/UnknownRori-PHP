<?php

namespace Core;

use Core\Database\DB;

class Model implements IModel
{
    protected $table;

    /**
     * Find specific id value inside the model table
     */
    public static function find($id)
    {
        $self = new static;
        return DB::table($self->table)->find($id);
    }

    /**
     * Get all value inside the model table
     */
    public static function all()
    {
        $self = new static;
        return DB::table($self->table)->select();
    }

    /**
     * Run sql where command inside the model table
     */
    public static function where($column, $value, $logic = '=')
    {
        $self = new static;
        return DB::table($self->table)->where($column, $value, $logic);
    }

    /**
     * Just like all this one do paginate thing inside the model table
     */
    public static function paginate($perPage)
    {
        $self = new static;
        return DB::table($self->table)->paginate($perPage);
    }
}
