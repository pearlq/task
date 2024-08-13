<?php

namespace database\migrations;

use core\Database;
use models\User;

class CreateUsersTable
{
    private Database $database;
    public function __construct()
    {
        $this->database = new Database();
    }

    public function up(): void
    {
        $this->database->createTable('../database/sql/create_users_table.sql');
    }
    public function insert(): void
    {
        $user = new User();
        $password = password_hash('test', PASSWORD_DEFAULT);
        $user->create('test', $password, 'Админ', 1);
    }
    public function down(): void
    {
        $this->database->dropTable('users');
    }
}