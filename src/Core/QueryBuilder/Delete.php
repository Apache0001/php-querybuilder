<?php
namespace Core\QueryBuilder;
use Core\Database\Connect;

/**
 * Class Delete
 */
class Delete
 {
    private string $sql;

    private array $whereDelete = [];

    public function delete(
        string $table,
    ) {
        $this->sql = "DELETE FROM {$table}";
        return $this;
    }

     /**
     * where
     * @param string  $field
     * @param string  $operator
     * @param mixed   $value
     * @return Delete $this;
     */
    public function where(
        string $key, 
        string $operator, 
        mixed $value
        ) {
        $this->sql .= " WHERE {$key} {$operator} :{$key}";
        $this->whereDelete[$key] = $value;
        return $this;
    }

    /**
     * execute 
     */
    public function execute()
    {
        $con = Connect::getInstance();
        $stmt = $con->prepare($this->sql);
        $return = $stmt->execute(
            $this->whereDelete
        );
    }

 }