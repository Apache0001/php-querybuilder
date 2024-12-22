<?php
require_once __DIR__.'/../vendor/autoload.php';

use Core\Database\Connect;
use Core\QueryBuilder\Select;
use Core\QueryBuilder\Create;

# dotenv
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

// $con = Connect::getInstance();
// $select = (new Select())->query('SELECT * FROM posts')
//     ->where('user_id', '=', 36)
//     ->orWhere('user_id', '=', 9)
//     ->get();

$create = (new Create())->create(
    'users', [
        
        'firstName' => 'Pablo',
        'lastNAme'  => 'Oliveira',
        'email'     => 'pablomesquita@.id.uff.br',
        'password'  => password_hash('123', PASSWORD_DEFAULT)
        
        
    ]
);
var_dump($create);

