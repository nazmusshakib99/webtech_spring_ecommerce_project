<?php

require_once "../config/database.php";

class Review{

    private PDO $conn;

    private string $table = "reviews";

    public function __construct(){

        $database = new Database();

        $this->conn = $database->conn;

    }

    public function getReviewsByProduct(int $product_id): array{

        $query = "SELECT * FROM " . $this->table . "
                  WHERE product_id = :product_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function addReview(
        int $product_id,
        string $user_name,
        int $rating,
        string $comment
    ): bool{

        $query = "INSERT INTO " . $this->table . "
                    (product_id, user_name, rating, comment)
                    VALUES
                    (:product_id, :user_name, :rating, :comment)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);

        $stmt->bindParam(":user_name", $user_name);

        $stmt->bindParam(":rating", $rating, PDO::PARAM_INT);

        $stmt->bindParam(":comment", $comment);

        return $stmt->execute();

    }

}
?>