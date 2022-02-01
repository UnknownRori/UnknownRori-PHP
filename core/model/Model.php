<?php

namespace Core;

use Core\Database\DB;

class Model implements IModel
{
    protected $table;
    protected $hasMany;
    protected $belongsTo;

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
        if ($self->belongsTo()) {
            $data = $self->belongsTo();
            $foreign_model = new $data[0]();
            $query = "SELECT * FROM {$self->table} LEFT JOIN {$foreign_model->table} ON {$self->table}.{$data[1]} = {$foreign_model->table}.id";
            return DB::prepare($query)->fetchAll();
        } else if ($self->hasMany()) {
            $data = $self->hasMany();
            $foreign_model = new $data[0]();
            $query = "SELECT * FROM {$self->table} LEFT OUTER JOIN {$foreign_model->table} ON {$self->table}.id = {$foreign_model->table}.{$data[1]}";
            // dd($query);
            return DB::prepare($query)->fetchAll();
        } else {
            return DB::table($self->table)->all();
        }
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

    protected function belongsTo()
    {
        return $this->belongsTo;
    }

    protected function hasMany()
    {
        return $this->hasMany;
    }
}
