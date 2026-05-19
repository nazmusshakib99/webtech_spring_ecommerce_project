<?php

require_once "../config/database.php";

class Order{

    private PDO $conn;

    public function __construct(){

        $database = new Database();

        $this->conn = $database->conn;

    }

    public function getAllOrders(): array{

        $query = "SELECT * FROM orders";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getOrdersByUser(int $userId): array{

        $query = "SELECT * FROM orders WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
?>