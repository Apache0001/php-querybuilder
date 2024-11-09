<?php
namespace Core\QueryBuilder;

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
        $this->where = " WHERE {$field} {$operator} :{$field}";
        $this->setExecute($field, $value);
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

        $this->setExecute($field, $value);
        $this->andWhere .= " AND {$field} {$operator} :{$field}";

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

        $this->setExecute($field, $value);
        $this->andWhere .= " OR {$field} {$operator} :{$field}";

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
        $this->execute[] = [ 
            $key => $value
        ];
    }

    /**
     * get
     * @return string
     */
    public function get(): string
    {
        return 
            $this->query . 
            $this->where . 
            $this->andWhere . 
            $this->limit .
            $this->order;
    }
}

