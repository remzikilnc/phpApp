<?php

namespace App\Library\Database;

use App\Library\Response\JsonResponse;
use PDO;
use PDOException;
use Pixie\Connection;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Database
{

    /**
     * @throws Exception
     */
    public static function getQueryBuilder(): QueryBuilderHandler
    {
        $connection = Connection::getStoredConnection();
        if ($connection !== null){
            return new QueryBuilderHandler($connection, \PDO::FETCH_ASSOC);
        }
        return new QueryBuilderHandler(new Connection( 'mysql', self::getMysqlConfig()), \PDO::FETCH_ASSOC);
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