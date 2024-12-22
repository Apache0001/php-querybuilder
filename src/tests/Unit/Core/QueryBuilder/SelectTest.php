<?php
namespace tests\Unit\Core\QueryBuilder;
use PHPUnit\Framework\TestCase;
use Core\QueryBuilder\Select;

class SelectTest extends TestCase
{
    private Select $select;

    public function setUp(): void
    {
        parent::setUp();
        $this->select = new Select;
    }
    public function test_get_simple_select(): void
    {
        $query = $this->select->query('SELECT * FROM users')->get();
        $this->assertEquals('SELECT * FROM users', $query);
    }

    public function test_get_select_with_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')->where('id', '>', 1)->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id', $query);
    }

    public function test_get_select_with_more_than_one_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
        ->where('id', '>', 1)
        ->andWhere('firstName', '=', 'Pablo')
        ->andWhere('lastName', '=', 'Oliveira')
        ->get();

        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName AND lastName = :lastName', $query);
    }

    public function test_get_select_with_and_where_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
        ->where('id', '>', 1)
        ->andWhere('firstName', '=', 'Pablo')
        ->andWhere('lastName', '=', 'Oliveira')
        ->get();

        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName AND lastName = :lastName', $query);
    }

    public function test_get_select_with_or_where_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
        ->where('id', '>', 1)
        ->orWhere('firstName', '=', 'Pablo')
        ->orWhere('lastName', '=', 'Oliveira')
        ->get();

        $this->assertEquals('SELECT * FROM users WHERE id > :id OR firstName = :firstName OR lastName = :lastName', $query);
    }

    public function test_get_select_with_or_and_where_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
        ->where('id', '>', 1)
        ->andWhere('firstName', '=', 'Pablo')
        ->orWhere('lastName', '=', 'Oliveira')
        ->get();

        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName OR lastName = :lastName', $query);
    }

    public function test_get_select_with_limit_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
        ->where('id', '>', 1)
        ->limit(10)
        ->get();

        $this->assertEquals('SELECT * FROM users WHERE id > :id LIMIT 10', $query);
    }
}
