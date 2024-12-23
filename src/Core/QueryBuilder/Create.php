<?php
namespace Core\QueryBuilder;

class Create 
{
    /** @var string $sql */
    protected string  $sql;

    /** @var string $query */
    protected string  $query;

    private array $execute = [];

    /**
     * create
     * @param string $table
     * @param array  $data
     */
    public function create(
        string $table,
        array $data
    ) {
        $this->sql = "INSERT INTO {$table}";

        return $this->prepareData(
            $data
        );
    }

    /**
     * prepareData
     * @param array $data
     * @return Create
     */
    private function prepareData(
        array $data
    ) : Create
    {
        $this->sql .= '('.implode(', ', array_keys($data)). ') values(';
        $this->sql .= ':'.(implode(', :', array_keys($data))).')';
        $this->setExecute($data);
        return $this;
    }

    /**
     * setExecute
     * @param array $data
     */
    private function setExecute(
        array $data
    ) {
        $this->execute = $data;
    }
}