<?php
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

return [
    'dsn' => 'pgsql:' .
        'host='. $_ENV['DB_HOST'] . ';' .
        'port=' . $_ENV['DB_PORT'] . ';' .
        'dbname=' . $_ENV['DB_DATABASE']
    ,
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
];