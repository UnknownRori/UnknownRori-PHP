<?php

namespace Core\Database;

use Core\KernelException;
use Core\Support\Collection;
use Exception;
use PDO;

class DB implements IDB
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
                $_ENV['DB_PASSWORD']
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, require("{$_ENV['APP_DIR']}/config/db.php"));
        } catch (Exception $e) {
            KernelException::PDO_ERROR($e);
        }
    }

    /**
     * Basic DB Function
     */

    /**
     * Doing raw query
     */
    public static function query(string $query)
    {
        $DB = new static;
        $DB->query = $DB->connect->query($query);
        return $DB;
    }

    /**
     * Doing prepared statement query
     */
    public static function prepare(string $query)
    {
        $DB = new static;
        $DB->query = $DB->connect->prepare($query);
        return $DB;
    }

    /**
     * Execute current query,
     * can passed argumment for prepared statement
     */
    public function execute(array $value = [])
    {
        $this->query->execute($value);
        return $this;
    }

    /**
     * Execute current query and close the connection,
     * can passed argumment for prepared statement
     */
    public function executeclose(array $value = [])
    {
        $return = $this->query->execute($value);
        $this->close();
        return $return;
    }

    /**
     * Fetch all data
     */
    public function fetchAll(array $value = [])
    {
        $this->execute($value);
        $data = $this->query->fetchAll();
        $data = new Collection($data);
        $this->close();
        return $data;
    }

    /**
     * Fetch single data
     */
    public function fetch(array $value = [])
    {
        $this->execute($value);
        $data = $this->query->fetch();
        $data = new Collection($data);
        $this->close();
        return $data;
    }

    /**
     * Close the Connection
     */
    public function close()
    {
        $this->query = null;
        $this->connect = null;
    }

    /**
     * Predefined DB function, Use Prepared Statement,
     * by using predefined DB function it will automaticaly close the connection
     */

    /**
     * Selecting Table to interact with
     */
    public static function table(string $table)
    {
        $DB = new static;
        $DB->table = $table;
        return $DB;
    }

    /**
     * Insert data into table
     */
    public function insert(array $value = [])
    {
        $key = array_keys($value);
        $parameter = array_map(function ($val) {
            return ":{$val}";
        }, $key);

        $key = implode(", ", $key);
        $parameter = implode(", ", $parameter);
        $return = self::prepare("INSERT INTO {$this->table} ({$key}) VALUES({$parameter})")->executeclose($value);
        return $return;
    }

    /**
     * Deleting data in the table
     */
    public function delete(int $id)
    {
        $return = self::prepare("DELETE FROM `users` WHERE id=?")->executeclose([$id]);
        return $return;
    }

    /**
     * Fetch specific data in table
     */
    public function find($value, string $column = 'id')
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE {$column}=?")->fetch([$value]);
        $data->set_table($this->table);
        return $data;
    }

    /**
     * Doing 'where' sql command
     * @param $column string is target column
     * @param $value string is search value
     * @param $method string is method used for getting data
     * @param $logic string is logic '<', '>', '=', '>=', '<=', '<>', 'LIKE', 'BETWEEN', 'IN'
     */
    public function where(string $column, string $value, string $method = 'fetchAll', string $logic = '=')
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE {$column}{$logic}?")->$method([$value]);
        return $data;
    }

    /**
     * Get all values inside table
     */
    public function all()
    {
        $data = self::prepare("SELECT * FROM {$this->table}")->fetchAll();
        return $data;
    }

    /**
     * Update specific primary key in table
     */
    public function update(array $value)
    {
        $key = array_keys($value);
        unset($value[0]);
        $parameter = array_map(function ($key) {
            return "{$key}=:{$key}";
        }, $key);

        $parameter = implode(", ", $parameter);
        $return = self::prepare("UPDATE {$this->table} SET {$parameter} WHERE id=:id")->executeclose($value);
        return $return;
    }

    /**
     * Doing automatic paginate thing
     */
    public function paginate(int $perPage)
    {
        if (!empty($_GET['page'])) {
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $perPage;

        $data = self::prepare("SELECT * FROM {$this->table} LIMIT {$offset}, {$perPage}")->fetchAll();
        $total = self::prepare("SELECT count(id) as total FROM {$this->table}")->fetch();

        $data->set_total(intval($total->get('total')));
        $data->set_perPage($perPage);

        return $data;
    }
}
