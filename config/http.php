<?php
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

return [
    'secret_key' => $_ENV['SECRET_KEY'],
];