<?php
namespace app\Library\QueryBuilder;

use App\Library\Database\Database;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class QueryBuilderFacade
{
    private QueryBuilderHandler $queryBuilder;

    /**
     * @throws Exception
     */
    public function __construct($table)
    {
        $this->queryBuilder = Database::getQueryBuilder()->table($table);
    }

    public function where($key, $operator, $value): QueryBuilderFacade
    {
        $this->queryBuilder->where($key, $operator, $value);
        return $this;
    }

    public function whereNot(string $key, string $operator = null, mixed $value = null): QueryBuilderFacade
    {
        $this->queryBuilder->whereNot($key, $operator, $value);
        return $this;
    }

    public function orderBy(string $field, string $defaultDirection = 'ASC'): QueryBuilderFacade
    {
        $this->queryBuilder->orderBy($field, $defaultDirection);
        return $this;
    }

    public function limit(int $limit): QueryBuilderFacade{
        $this->queryBuilder->limit($limit);
        return $this;
    }

    public function find(mixed $value, string $fieldName): QueryBuilderFacade
    {
        $this->queryBuilder->find($value, $fieldName);
        return $this;
    }

    public function count(): QueryBuilderFacade
    {
        $this->queryBuilder->count();
        return $this;
    }

}