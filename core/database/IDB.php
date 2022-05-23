<?php

namespace Core\Database;

interface IDB
{
    /**
     * Basic DB method
     */
    public static function query(string $query);
    public static function prepare(string $query);
    public function execute(array $value = []);
    public function executeClose(array $value = []);
    public function fetchAll(array $value = []);
    public function fetch(array $value = []);
    public function close();

    /**
     * Built in DB method
     */
    public static function table(string $table);
    public function create(array $value = []);
    public function destroy(int $id);
    public function update(array $value);
    public function find($value, string $column);
    public function where(string $column, string $value, string $logic = '=');
    public function all($column);
    public function paginate(int $perPage);
}
