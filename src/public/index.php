<?php
require_once __DIR__.'/../vendor/autoload.php';

use Core\Database\Connect;
use Core\QueryBuilder\Select;
use Core\QueryBuilder\Update;
use Core\QueryBuilder\Delete;

# dotenv
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

// $con = Connect::getInstance();
// $select = (new Select())->query('SELECT * FROM posts')
//     ->where('user_id', '=', 36)
//     ->orWhere('user_id', '=', 9)
//     ->execute();

// $update = new Update;

// $update = $update->update('users', [
//         'firstName' => 'Pablooo',
//         'lastName'  => 'Oliveira',
//         'email'     => 'pablomesquita@.id.uff.br',
//         'password'  => password_hash('123', PASSWORD_DEFAULT)
//     ]
// );
// $update->where('id', 100)->execute();


$delete = new Delete;
$delete = $delete->delete('users')->where('id','=', 4);

var_dump($delete);

