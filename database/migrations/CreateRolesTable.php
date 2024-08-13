<?php

namespace database\migrations;

use core\Database;

class CreateRolesTable
{
    private Database $database;
    public function __construct()
    {
        $this->database = new Database();
    }

    public function up(): void
    {
        $this->database->createTable('../database/sql/create_roles_table.sql');
    }
    public function down(): void
    {
        $this->database->dropTable('roles');
    }
}