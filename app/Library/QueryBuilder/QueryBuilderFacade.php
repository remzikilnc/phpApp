<?php

namespace app\Library\QueryBuilder;

use App\Library\Database\Database;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class QueryBuilderFacade
{
    private $table;
    private QueryBuilderHandler $queryBuilder;

    /**
     * @throws Exception
     */
    public function __construct($table)
    {
        $this->$table = $table;
        $this->queryBuilder = Database::getQueryBuilder()->table($this->$table);
    }

    /**
     * @throws Exception
     */
    public function get(): array
    {
        $queryResult = $this->queryBuilder->get();
        $this->resetQueryBuilder();
        return $queryResult;
    }

    public function where($key, $operator, $value): QueryBuilderFacade
    {
        $this->queryBuilder->where($key, $operator, $value);
        return $this;
    }

    public function whereNot(string $key, string $operator = null, mixed $value = null)
    {
        $this->queryBuilder->whereNot($key, $operator, $value);
        return $this;
    }

    public function orderBy(string $field, string $defaultDirection = 'ASC'): QueryBuilderFacade
    {
        $this->queryBuilder->orderBy($field, $defaultDirection);
        return $this;
    }

    public function limit(int $limit): QueryBuilderFacade
    {
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

    /**
     * @throws Exception
     */
    public function insert(array $data): array|string
    {
        $insertIds = $this->queryBuilder->insert($data);
        $this->resetQueryBuilder();
        return $insertIds;
    }

    /**
     * @throws Exception
     */
    public function update(array $data): void
    {
        $this->queryBuilder->update($data);
        $this->resetQueryBuilder();

    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        $this->queryBuilder->delete();
        $this->resetQueryBuilder();
    }

    /**
     * @throws Exception
     */
    private function resetQueryBuilder(): void
    {
        $this->queryBuilder = $this->queryBuilder->table($this->table);
    }

}