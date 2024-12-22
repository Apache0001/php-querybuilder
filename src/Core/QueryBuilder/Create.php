<?php
namespace Core\QueryBuilder;

class Create 
{
    /** @var string $sql */
    protected string  $sql;

    /** @var string $query */
    protected string  $query;

    private array $execute = [];

    public function create(
        string $table,
        array $data
    ) {
        $this->sql = "INSERT INTO {$table}";

        return $this->prepareData(
            $data
        );
    }

    private function prepareData(array $data)
    {
        $this->sql .= '('.implode(', ', array_keys($data)). ') values(';
        $this->sql .= ':'.(implode(', :', array_keys($data))).')';
        $this->setExecute($data);
        return $this;
    }

    private function setExecute(array $data)
    {
        $this->execute = $data;
    }
}