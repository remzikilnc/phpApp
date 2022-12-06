<?php

namespace App\Library\Database;

use App\Library\Response\JsonResponse;
use PDO;
use PDOException;

class Database
{
    public PDO $connect;

    public function __construct()
    {
        $config = self::getMysqlConfig();
        try {
            $this->connect = new PDO($config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'], $config['username'], $config['password']);
            $this->connect->query('SET CHARACTER SET ' . $config['charset'] ?? 'utf8');
        } catch (PDOException $e) {
            $response = new JsonResponse();
            $response->setStatusCode(500)->setMessage("Database Connection Error")->send();
            exit();
        }
    }

    /**
     * @param $sql
     * @param bool $multi
     * @return array
     */
    public function query($sql, bool $multi = false): array
    {
        if ($multi === false) {
            return $this->connect->query($sql, PDO::FETCH_ASSOC)->fetch() ?? [];
        } else {
            return $this->connect->query($sql, PDO::FETCH_ASSOC)->fetchAll() ?? [];
        }
    }

    private static function getMysqlConfig(): array
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