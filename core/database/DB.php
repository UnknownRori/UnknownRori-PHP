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

    /**
     * Initialize Database Connection
     * @return void
     */
    public function __construct()
    {
        try {
            $this->connect = new PDO(
                env('DB_CONNECTION', 'mysql') . ":host=" . env('DB_HOST', 'localhost') .
                    ";dbname=" . env('DB_DATABASE', 'unknownrori'),
                env('DB_USERNAME', 'root'),
                env('DB_PASSWORD')
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, require("{$_ENV['APP_DIR']}/config/db.php"));
        } catch (Exception $e) {
            KernelException::PDO_ERROR($e);
        }
    }

    /**
     * Basic DB Method
     */

    /**
     * Doing raw query
     * @param  string $query
     * @return static
     */
    public static function query(string $query)
    {
        $DB = new static;
        $DB->query = $DB->connect->query($query);
        return $DB;
    }

    /**
     * Doing prepared statement query
     * @param  string $query
     * @return static
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
     * @param  array $value
     * @return boolean
     */
    public function execute(array $value = [])
    {
        $this->query->execute($value);
        return $this;
    }

    /**
     * Execute current query and close the connection,
     * can passed argumment for prepared statement
     * @param  array $value
     * @return boolean
     */
    public function executeClose(array $value = [])
    {
        $return = $this->query->execute($value);
        $this->close();
        return $return;
    }

    /**
     * Fetch all data
     * @param  array $value
     * @return \Core\Support\Collection
     */
    public function fetchAll(array $value = [])
    {
        $this->execute($value);
        $data = $this->query->fetchAll();

        $data = collect($data);
        $data->removeKeyInt();

        $this->close();
        return $data;
    }

    /**
     * Fetch single data
     * @param  array $value
     * @return \Core\Support\Collection
     */
    public function fetch(array $value = [])
    {
        $this->execute($value);
        $data = $this->query->fetch();

        $data = collect($data);
        $data->removeKeyInt();

        $this->close();
        return $data;
    }

    /**
     * Close the Connection
     * @return void
     */
    public function close()
    {
        $this->query = null;
        $this->connect = null;
    }

    /**
     * Built in DB method, Use Prepared Statement,
     * by using built in DB method it will automaticaly close the connection
     */

    /**
     * Selecting Table to interact with
     * @param  string $table
     * @return static
     */
    public static function table(string $table)
    {
        $DB = new static;
        $DB->table = $table;
        return $DB;
    }

    /**
     * Insert data into table
     * @param  array $value
     * @return boolean
     */
    public function create(array $value = [])
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
     * @param  int $id
     * @return boolean
     */
    public function destroy(int $id)
    {
        $return = self::prepare("DELETE FROM {$this->table} WHERE id=?")->executeclose([$id]);
        return $return;
    }

    /**
     * Fetch specific data in table
     * @param string|int $id
     * @return \Core\Support\Collection
     */
    public function find($id, string $column = 'id')
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE {$column}=?")->fetch([$id]);
        $data->set_table($this->table);
        return $data;
    }

    /**
     * Doing 'where' sql command
     * @param $column string is target column
     * @param $value string is search value
     * @param $method string is method used for getting data
     * @param $logic string is logic '<', '>', '=', '>=', '<=', '<>', 'LIKE', 'BETWEEN', 'IN'
     * @return \Core\Support\Collection
     */
    public function where(string $column, string $value, string $method = 'fetchAll', string $logic = '=')
    {
        $data = self::prepare("SELECT * FROM {$this->table} WHERE {$column}{$logic}?")->$method([$value]);
        return $data;
    }

    /**
     * Get all values inside table
     * @param   string $column
     * @return  \Core\Support\Collection
     */
    public function all($column = '*')
    {
        $data = self::prepare("SELECT {$column} FROM {$this->table}")->fetchAll();
        return $data;
    }

    /**
     * Update specific primary key in table
     * @param  array $value
     * @return boolean
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
     * @param  int $perPage
     * @return \Core\Support\Collection
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
