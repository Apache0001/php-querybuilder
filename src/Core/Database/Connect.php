<?php

namespace Core\Database;

use PDOException;

/**
 * [ Class Singleton Connect ]
 * 
 */
class Connect
{
    /** @var ?\PDO $instance */
    private static $instance = null;

    /** @var array<int,int> $options */
    private static ?array $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    /**
     * static function getInstance
     * @return \PDO
     */
    public static function getInstance(): \PDO
    {
        if(empty(self::$instance)) {
            try{
                self::$instance =  new \PDO(
                    "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME']."",
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASSWD'],
                    self::$options
                );
            }catch(PDOException $ex) {
                var_dump($ex->getMessage());
            }
            
        }
        return self::$instance;
    }

    private function __clone(){}

    private function __construct(){}
}