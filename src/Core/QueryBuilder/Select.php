<?php
namespace Core\QueryBuilder;

use Core\Database\Connect;

/**
 * [ Class Select ]
 */
class Select
{
    /** @var string $sql */
    protected string  $sql;

    /** @var string $query */
    protected string  $query;

    /** @var null|string $where */
    protected ?string $where  = null;

    /** @var null|string $order */
    protected ?string $order  = null;

    /** @var null|string $limit */
    protected ?string $limit  = null;

    /** @var array<int, array<string, mixed>> $execute */
    protected array  $execute = [];

    /** @var null|string $andWhere */
    protected ?string  $andWhere = null;
    
    /**
     * query
     * @param string  $query
     * @return Select $this;
     */
    public function query(
        string $query
    ): Select {
        $this->query = $query;
        return $this;
    }

    /**
     * where
     * @param string  $field
     * @param string  $operator
     * @param mixed   $value
     * @return Select $this;
     */
    public function where(
        string $field, 
        string $operator,
        mixed $value
    ): Select {
        $id = uniqid($field.'_');
        $this->setExecute($id, $value);
        $this->where = " WHERE {$field} {$operator} :{$id}";
        return $this;
    }

     /**
     * andWhere
     * @param string $field
     * @param string $operator
     * @param mixed  $value
     * @return Select
     */
    public function andWhere(
        string $field, 
        string $operator,
        mixed $value
    ): Select {
        $id = uniqid($field.'_');
        $this->setExecute($id, $value);
        $this->andWhere .= " AND {$field} {$operator} :{$id}";

        return $this;
    }

    /**
     * andWhere
     * @param string  $field
     * @param string  $operator
     * @param mixed   $value
     * @return Select $this;
     */
    public function orWhere(
        string $field, 
        string $operator,
        mixed $value
    ): Select {

        $id = uniqid($field.'_');
        $this->setExecute($id, $value);
        $this->andWhere .= " OR {$field} {$operator} :{$id }";

        return $this;
    }

    /**
     * order
     * @param string $order
     * @return Select $this;
     */
    public function order(
        string $order
    ): Select {
        $this->order = " ORDER BY {$order}";
        return $this;
    }
    
     /**
     * limit
     * @param int $limit
     * @return Select $this;
     */
    public function limit(
        int $limit
    ): Select {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }
 
    /**
     * setExecute
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function setExecute(
        string $key, 
        mixed $value
    ): void {
        $this->execute[$key] = $value;
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
     * getQuery
     * @return string
     */
    public function getQuery(): string
    {
        return 
            $this->query    . 
            $this->where    . 
            $this->andWhere . 
            $this->limit    .
            $this->order    ;
    }
    /**
     * get
     * @return null|array
     */
    public function get(): ?array
    {
        $con  = Connect::getInstance();

        $stmt = $con->prepare(
            $this->getQuery()
        );

        $stmt->execute(
            $this->getExecute()
        );
        return $stmt->fetchAll();
        
    }
}

