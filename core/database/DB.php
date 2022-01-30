<?php

namespace Core\Database;

use Core\KernelException;
use Exception;
use PDO;

class DB
{
    protected $connect;
    protected $query;
    protected $table;

    public function __construct()
    {
        try {
            $this->connect = new PDO(
                "{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}",
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'],
                require("{$_ENV['APP_DIR']}/config/db.php")
            );
        } catch (Exception $e) {
            KernelException::PDO_ERROR($e);
        }
    }

    public static function query($query)
    {
        $DB = new static;
        $DB->query = $DB->connect->query($query);
        return $DB;
    }

    public static function prepare($query)
    {
        $DB = new static;
        $DB->query = $DB->connect->prepare($query);
        return $DB;
    }

    public function execute($value = [])
    {
        $this->query->execute($value);
        return $this;
    }

    public function fetchAll()
    {
        $data = $this->query->fetchAll();
        $this->query = null;
        return $data;
    }

    public function fetch()
    {
        $data = $this->query->fetch();
        $this->query = null;
        return $data;
    }

    public function close()
    {
        $this->connect = null;
    }


    public static function table($table)
    {
        $DB = new static;
        $DB->table = $table;
        return $DB;
    }

    public function insert($value = [])
    {
        $key = array_keys($value);
        $parameter = array_map(function ($val) {
            return ":{$val}";
        }, $key);

        $key = implode(", ", $key);
        $parameter = implode(", ", $parameter);

        return self::prepare("INSERT INTO {$this->table} ({$key}) VALUES({$parameter})")->execute($value);
    }

    public function delete($id)
    {
        return self::prepare("DELETE FROM `users` WHERE id=?")->execute([$id]);
    }

    public function find($id)
    {
        return self::prepare("SELECT * FROM {$this->table} WHERE id=?")->execute([$id])->fetch();
    }

    public function where($column, $logic = '=', $value)
    {
        return self::prepare("SELECT * FROM {$this->table} WHERE {$column}{$logic}?")->execute([$value]);
    }
}
