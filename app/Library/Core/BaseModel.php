<?php

namespace App\Library\Core;

class BaseModel
{
    protected static QueryBuilderFacade $QueryBuilderFacade;

    public static function getQueryBuilder()
    {
        return static::getQueryBuilderFacadeInstance();
    }

    private static function getQueryBuilderFacadeInstance(): QueryBuilderFacade
    {
        if (!isset(static::$QueryBuilderFacade)) {

            static::$QueryBuilderFacade = new QueryBuilderFacade(static::$entity);
            return static::$QueryBuilderFacade;
        } elseif (isset(static::$QueryBuilderFacade) && static::$QueryBuilderFacade->getEntity() != static::$entity) {

            static::$QueryBuilderFacade = new QueryBuilderFacade(static::$entity);
            return static::$QueryBuilderFacade;
        }
        return static::$QueryBuilderFacade;
    }

}