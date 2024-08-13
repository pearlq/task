<?php

namespace core;

class Model
{
    protected \PDO $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

}