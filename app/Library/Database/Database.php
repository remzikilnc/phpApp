<?php

namespace App\Library\Database;

use App\Core\BaseModel;
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
        $queryBuilder =  new QueryBuilderHandler(new Connection( 'mysql', self::getMysqlConfig()), \PDO::FETCH_ASSOC);
        static::createDbEvents($queryBuilder);
        return $queryBuilder;
    }

    private static function getMysqlConfig(): array
    {
        require BASEDIR . '/config/database.php';
        $config['host'] = $database_config['host'];
        $config['database'] = $database_config['database'];
        $config['username'] = $database_config['username'];
        $config['password'] = $database_config['password'];
        $config['driver'] = $database_config['driver'];
        $config['charset'] = $database_config['charset'];
        $config['collation'] = 'utf8_unicode_ci';
        return $config;
    }

    private static function createDbEvents(QueryBuilderHandler $queryBuilderHandler): void
    {

        BaseModel::registerAllEvents($queryBuilderHandler);

    }
}