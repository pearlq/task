<?php

namespace core;

use PDO;
use PDOException;

class Database
{
    public $conn;
    public function connect(): PDO
    {
        $this->conn = null;
        $database_config = require "../config/database.php";

        try {
            $this->conn = new PDO(
                $database_config['dsn'],
                $database_config['username'],
                $database_config['password'],
            );
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function createTable(string $path): bool
    {
        $pdo = $this->connect();

        try {
            $sql = file_get_contents($path);
            $pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function dropTable(string $table): bool
    {
        $pdo = $this->connect();

        try {
            $pdo->exec("DROP TABLE IF EXISTS $table");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}