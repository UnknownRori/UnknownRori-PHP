<?php

namespace Core;

use Core\Database\DB;
use Exception;

class BaseModel implements IBaseModel
{
    protected $table;

    protected $primary_key = 'id';

    /**
     * Find specific id value inside the model table
     * can get value in other table using relation but only once
     * @param  string $relation belongsTo, hasMany
     * @return \Core\Support\Collection
     */
    public static function find($id, $relation = null)
    {
        $self = new static;

        if ($relation != null) {
            if (property_exists($self, $relation)) {
                $data = $self->$relation();
                $foreign_model = new $data[0]();

                if ($relation == 'hasMany') {
                    $query = "SELECT 
                    {$self->table}.{$self->primary_key} as {$self->table}_id, {$self->table}.*,
                    {$foreign_model->table}.{$foreign_model->primary_key} as {$foreign_model->table}_id, {$foreign_model->table}.*
                    FROM users 
                    LEFT JOIN post ON {$foreign_model->table}.{$data[1]} = {$self->table}.{$self->primary_key}
                    WHERE {$self->table}.{$self->primary_key}=?";
                    $method = 'fetchAll';
                } else if ($relation == 'belongsTo') {
                    $query = "SELECT {$self->table}.{$self->primary_key} as {$self->table}_id, {$self->table}.*, 
                    {$foreign_model->table}.{$foreign_model->primary_key} as {$foreign_model->table}_id, {$foreign_model->table}.* 
                    FROM users LEFT JOIN post ON {$foreign_model->table}.{$foreign_model->primary_key} = {$self->table}.{$data[1]} 
                    WHERE {$self->table}.{$self->primary_key}=?";
                    $method = 'fetch';
                }
                $result = DB::prepare($query)->$method([$id]);

                // Filter the result and remove all number

                if (is_array($result->get()[0])) {
                    $result->map(function ($data) {
                        return array_filter($data, function ($key) {
                            if (is_int($key)) return false;
                            return true;
                        }, ARRAY_FILTER_USE_KEY);
                    });
                } else {
                    $result->filter(function ($key) {
                        if (is_int($key)) return false;
                        return true;
                    });
                }

                $result->save();
                $result->set_table($self->table);

                return $result;
            } else {
                KernelException::undefinedRelation($relation);
            }
        }


        return DB::table($self->table)->find($id);
    }

    /**
     * Get all value inside the model table
     * can get value in other table using relation but only once
     * @param  string $relation belongsTo, hasMany
     * @return \Core\Support\Collection
     */
    public static function all($relation = null)
    {
        $self = new static;

        if (!is_null($relation)) {
            if (property_exists($self, $relation)) {
                $data = $self->$relation();
                $foreign_model = new $data[0]();

                if ($relation == 'hasMany') {
                    $query = "SELECT 
                    {$self->table}.{$self->primary_key} as {$self->table}_id, {$self->table}.*,
                    {$foreign_model->table}.{$foreign_model->primary_key} as {$foreign_model->table}_id, {$foreign_model->table}.*, 
                    {$self->table}.{$self->primary_key} as {$foreign_model->table}_{$self->table}_id
                    FROM users 
                    LEFT JOIN post ON {$foreign_model->table}.{$data[1]} = {$self->table}.{$self->primary_key}";
                } else if ($relation == 'belongsTo') {
                    $query = "SELECT 
                    {$self->table}.id as {$self->table}_id, {$self->table}.*,
                    {$foreign_model->table}.{$foreign_model->primary_key} as {$foreign_model->table}_id, {$foreign_model->table}.*, 
                    {$self->table}.{$foreign_model->table}_id as {$foreign_model->table}_{$self->table}_id
                    FROM users 
                    LEFT JOIN post ON {$foreign_model->table}.id = {$self->table}.{$data[1]}";
                }

                // Filter the result and remove all number

                $result = DB::prepare($query)->fetchAll();
                $result->map(function ($data) {
                    return array_filter($data, function ($key) {
                        if (is_int($key)) return false;
                        return true;
                    }, ARRAY_FILTER_USE_KEY);
                });

                $result->save();
                $result->set_table($self->table);

                return $result;
            } else {
                KernelException::undefinedRelation($relation);
            }
        }
        return DB::table($self->table)->all();
    }

    /**
     * Run sql where command inside the model table
     * @param  string $column
     * @param  mixed  $value
     * @param  string $logic
     * @param  string $method
     * @return \Core\Support\Collection
     */
    public static function where($column, $value, $logic = '=', $method = 'fecthAll')
    {
        $self = new static;
        return DB::table($self->table)->where($column, $value, $method, $logic);
    }

    /**
     * Run sql insert inside model table
     * @param  array $data
     * @return \Core\Support\Collection
     */
    public static function create(array $data)
    {
        $self = new static;
        return DB::table($self->table)->create($data);
    }

    /**
     * Delete specific data inside model table
     * @param  int $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $self = new static;
        return DB::prepare("DELETE FROM {$self->table} WHERE {$self->primary_key}=?")->executeclose([$id]);
    }

    /**
     * Just like `all` method this one do paginate thing inside the model table
     * @param  int $perPage
     * @return \Core\Support\Collection
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
