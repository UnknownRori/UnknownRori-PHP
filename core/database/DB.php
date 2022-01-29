<?php

namespace Core\Database;

use Core\KernelException;
use Exception;
use PDO;

class DB
{
    protected $connect;
    protected $query;

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
}
