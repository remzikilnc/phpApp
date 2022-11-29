<?php

namespace Core;

use mysql_xdevapi\Exception;
use PDOException;

class Database
{
    protected \PDO $connect;

    public function __construct()
    {
        require_once BASEDIR . 'config/database.php';
        try {
            if (!isset($database_config['type']) || !isset($database_config['host']) || !isset($database_config['database']) || !isset($database_config['username'])) {
                die();
            }
            $this->connect = new \PDO($database_config['type'] . ':host=' . $database_config['host'] . ';dbname=' . $database_config['database'], $database_config['username'], $database_config['password']);
            $this->connect->query('SET CHARACTER SET utf8');
            $this->connect->query('SET NAMES utf8');
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param $sql
     * @param bool $multi
     * @return array|false|mixed
     */
    public function query($sql, bool $multi = false):Array
    {
        if ($multi === false) {
            return $this->connect->query($sql, \PDO::FETCH_ASSOC)->fetch() ?? [];

        } else {
            return $this->connect->query($sql, \PDO::FETCH_ASSOC)->fetchAll() ?? [];
        }
    }
}