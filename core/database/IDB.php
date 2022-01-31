<?php

namespace Core\Database;

interface IDB
{
    /**
     * Basic DB function
     */
    public static function query(string $query);
    public static function prepare(string $query);
    public function execute(array $value = []);
    public function executeclose(array $value = []);
    public function fetchAll(array $value = []);
    public function fetch(array $value = []);
    public function close();
    /**
     * Pre Defined DB function
     */
    public static function table(string $table);
    public function insert(array $value = []);
    public function delete(int $id);
    public function find($value, string $column);
    public function where(string $column, string $value, string $logic = '=');
    public function all();
    public function paginate(int $perPage);
}
