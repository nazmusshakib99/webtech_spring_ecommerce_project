<?php

require_once "../config/database.php";

class Product{

    private PDO $conn;

    public function __construct(){

        $database = new Database();

        $this->conn = $database->conn;

    }

    public function getAllProducts(): array{

        $query = "SELECT * FROM products";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getProductById(int $id): array|false{

        $query = "SELECT * FROM products WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

}
?>