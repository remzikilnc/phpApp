<?php

namespace App\Library\Database;

use App\Core\BaseModel;
use Pixie\Connection;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Database
{
    private string $_host, $_database, $_user, $_password, $_charset;

    /**
     * @throws Exception
     */
    public function getQueryBuilder(): QueryBuilderHandler
    {
        $connection = Connection::getStoredConnection();
        if ($connection !== null) {
            return new QueryBuilderHandler($connection, \PDO::FETCH_ASSOC);
        }
        $queryBuilder = new QueryBuilderHandler(new Connection('mysql', $this->getConfig()), \PDO::FETCH_ASSOC);
        static::createDbEvents($queryBuilder);
        return $queryBuilder;
    }

    public function setConfig($config = []): Database
    {
        $this->_host = $config["DB_HOST"];
        $this->_database = $config["DB_DATABASE"];
        $this->_user = $config["DB_USERNAME"];
        $this->_password = $config["DB_PASS"];
        $this->_charset = $config["DB_CHARSET"];
        return $this;
    }

    private function getConfig(): array
    {
        return $config = [
            'host' => $this->_host,
            'database' => $this->_database,
            'username' => $this->_user,
            'password' => $this->_password,
            'charset' => $this->_charset,
        ];
    }

    private static function createDbEvents(QueryBuilderHandler $queryBuilderHandler): void
    {
        BaseModel::registerAllEvents($queryBuilderHandler);
    }
}