<?php

namespace models;

use core\Model;
use PDO;

require_once '../core/Model.php';

class Product extends Model
{
    public function create($name, $description, $price): bool
    {
        $sql = "INSERT INTO products (name, description, price) 
                VALUES (:name, :description, :price)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        return (bool) $stmt->execute();
    }

    public function update($product_id, $name, $description, $price): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE products SET name = :name, description = :description, price = :price 
             WHERE id = :product_id"
        );

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_id', $product_id);

        return (bool) $stmt->execute();
    }

    public function delete($product_id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :product_id");
        $stmt->bindParam(':product_id', $product_id);

        return (bool) $stmt->execute();
    }

    public function getById(int $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getProductList(): bool|array
    {
        $stmt = $this->conn
            ->prepare(
                "SELECT * FROM products ORDER BY name ASC"
            );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductStatistic(): array
    {
        $stmt = $this->conn->prepare("SELECT DATE(created_at) as date, COUNT(*) as count
            FROM products
            WHERE created_at >= (NOW()::date - INTERVAL '7 days')
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at)");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}