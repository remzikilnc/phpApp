<?php

namespace App\Core;

use App\Library\QueryBuilder\QueryBuilderFacade;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class BaseModel
{
    protected static QueryBuilderFacade $QueryBuilderFacade;

    /**
     * @throws Exception
     */
    public static function getQueryBuilder(): QueryBuilderFacade
    {
        return static::getQueryBuilderFacadeInstance();
    }

    /**
     * @throws Exception
     */
    private static function getQueryBuilderFacadeInstance(): QueryBuilderFacade
    {
        if (!isset(static::$QueryBuilderFacade)) {
            static::$QueryBuilderFacade = new QueryBuilderFacade(static::$table);
            return static::$QueryBuilderFacade;
        }
        return static::$QueryBuilderFacade;
    }

    /**
     * @throws Exception
     */
    public static function where($key, $operator = null, $value = null): \App\Library\QueryBuilder\QueryBuilderFacade
    {
        return static::getQueryBuilderFacadeInstance()->where($key, $operator, $value);
    }

    /**
     * @throws Exception
     */
    public static function all(): array
    {
        return self::getQueryBuilderFacadeInstance()->get();
    }

    public static function registerAllEvents(QueryBuilderHandler $queryBuilderHandler): void
    {

    }

}