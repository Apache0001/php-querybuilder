<?php

namespace Core\Database;

/**
 * [ Class Connect ]
 * 
 */
class Connect
{
    /** @var ?\PDO $instance */
    private static $instance = null;

    /** @var array<int, int> $options */
    private static ?array $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
    ];

    /**
     * static function getInstance
     * @return \PDO
     */
    public static function getInstance(): \PDO
    {
        if(empty(self::$instance)) {
            self::$instance =  new \PDO(
                "mysql:host=localhost;dbname=lumen",
                'root',
                '',
                self::$options
            );
        }
        return self::$instance;
    }

    private function __clone(){}

    private function __construct(){}
}