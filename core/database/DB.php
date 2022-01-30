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
                $_ENV['DB_PASSWORD'],
                require("{$_ENV['APP_DIR']}/config/db.php")
            );
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
        $this->table = null;
    }

    /**
     * Predefined DB function, by using predefined DB function it will automaticaly close the connection
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
        $this->close();
        return $return;
    }

    /**
     * Deleting data in the table
     */
    public function delete(int $id)
    {
        $return = self::prepare("DELETE FROM `users` WHERE id=?")->executeclose([$id]);
        $this->close();
        return $return;
    }

    /**
     * Fetch specific data in table
     */
    public function find(int $id)
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE id=?")->fetch([$id]);
        $this->close();
        return $data;
    }

    /**
     * Doing 'where' sql command
     */
    public function where(string $column, string $value, string $logic = '=')
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE {$column}{$logic}?")->fetchAll([$value]);
        return $data;
    }

    /**
     * Selecting entire table
     */
    public function select()
    {
        $data = self::prepare("SELECT * FROM {$this->table}")->fetchAll();
        return $data;
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

        $data = self::prepare("SELECT * FROM {$this->table} LIMIT {$offset}, $perPage")->fetchAll();
        return $data;
    }
}
