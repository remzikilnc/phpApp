<?php

namespace Core;

use mysql_xdevapi\Exception;
use PDOException;

class Database
{
    public \PDO $connect;

    /**
     * @throws \ErrorException
     */
    public function __construct()
    {
        $config = self::getMysqlConfig();
        try {
            if (!isset($config['driver']) || !isset($config['host']) || !isset($config['database']) || !isset($config['username'])|| !isset($config['password'] )) {
                throw new \ErrorException('There is a error about your database.',502);
                die();
            }
            $this->connect = new \PDO($config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'], $config['username'], $config['password']);
            $this->connect->query('SET CHARACTER SET '.$config['charset'] ?? 'utf8');
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param $sql
     * @param bool $multi
     * @return array|false|mixed
     */
    public function query($sql, bool $multi = false): array
    {
        if ($multi === false) {
            return $this->connect->query($sql, \PDO::FETCH_ASSOC)->fetch() ?? [];

        } else {
            return $this->connect->query($sql, \PDO::FETCH_ASSOC)->fetchAll() ?? [];
        }
    }

    private static function getMysqlConfig():array
    {
        require BASEDIR . '/config/database.php';
        $config['driver'] = $database_config['driver'];
        $config['host'] = $database_config['host'];
        $config['database'] = $database_config['database'];
        $config['username'] = $database_config['username'];
        $config['password'] = $database_config['password'];
        $config['charset'] = $database_config['charset'];
        return $config;
    }
}