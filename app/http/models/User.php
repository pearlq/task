<?php

namespace models;

use core\Model;
use PDO;

require_once '../core/Model.php';

class User extends Model
{
    public function create($login, $password, $full_name, $role_id): bool
    {
        $sql = "INSERT INTO users (login, password, full_name, role_id) 
                VALUES (:login, :password, :full_name, :role_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':role_id', $role_id);

        return (bool)$stmt->execute();
    }

    public function update($user_id, $login, $full_name, $role_id): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE users SET login = :login, full_name = :full_name, role_id = :role_id 
             WHERE id = :user_id"
        );

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':user_id', $user_id);

        return (bool)$stmt->execute();
    }

    public function delete($user_id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);

        return (bool)$stmt->execute();
    }

    public function getByLogin(string $login)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users u JOIN roles r ON u.role_id = r.id WHERE login = ?");
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById(int $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getUserList(): bool|array
    {
        $stmt = $this->conn
            ->prepare(
                "SELECT u.id, u.login, u.full_name, r.role, u.created_at       
                    FROM users u JOIN roles r ON u.role_id = r.id ORDER BY u.created_at ASC"
            );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserStatistic(): array
    {
        $stmt = $this->conn->prepare("SELECT DATE(created_at) as date, COUNT(*) as count
            FROM users
            WHERE created_at >= (NOW()::date - INTERVAL '7 days')
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at)");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}