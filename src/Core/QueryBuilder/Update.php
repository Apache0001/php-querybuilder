<?php
namespace Core\QueryBuilder;
use Core\Database\Connect;

/**
 * Class Update
 */
class Update
 {
    /** @var string $sql */
    private string $sql;

    /** @var array $execute */
    private array $execute = [];

    /** @var array $whereUpdate */
    protected array $whereUpdate = [];

    /**
     * update
     * @param string $table
     * @param array  $data
     */
    public function update(
        string $table,
        array $data
    ) {
        $this->sql = "UPDATE {$table} SET";

        foreach( $data as $key => $field ) {
            $this->sql .= " {$key} = :{$key},";
        }

        $this->sql = rtrim($this->sql, ',');

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

    /**
     * getExecute
     * @return array
     */
    private function getExecute(): array
    {
        return $this->execute;
    }

    /**
     * where
     * @param string $key
     * @param mixed  $value
     */
    public function where(
        string $key, 
        mixed $value
        ) {
        $this->sql .= " WHERE {$key} = :{$key}";
        $this->whereUpdate[$key] = $value;
        return $this;
    }

    /**
     * execute
     * @return Update
     */
    public function execute(): Update
    {
        // var_dump($this);exit;
        $con = Connect::getInstance();
        $stmt = $con->prepare($this->sql);
        $return = $stmt->execute(
            array_merge(
                $this->getExecute(),
                $this->whereUpdate
            )
        );

        return $this;
    }
 }