<?php

require_once "db.php";

class ProductModel extends Database {

    public function getAllProducts(){

        $connection = $this->connection();

        $sql = "SELECT * FROM products WHERE is_available = 1 ORDER BY id DESC";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Product Query Failed: " . mysqli_error($connection));
        }

        return $result;
    }

    public function searchProducts($keyword){

        $connection = $this->connection();

        $keyword = mysqli_real_escape_string($connection, $keyword);

        $sql = "SELECT * FROM products 
                WHERE is_available = 1 AND name LIKE '%$keyword%'
                ORDER BY name";

        return mysqli_query($connection, $sql);
    }

    public function getProductsByCategory($id){

        $connection = $this->connection();
        $id = intval($id);

        $sql = "SELECT * FROM products WHERE is_available = 1 AND category_id='$id' ORDER BY id DESC";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Category Product Query Failed: " . mysqli_error($connection));
        }

        return $result;
    }


    public function getProductById($id){

        $connection = $this->connection();
        $id = intval($id);

        $sql = "SELECT * FROM products WHERE id='$id' AND is_available = 1";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Single Product Query Failed: " . mysqli_error($connection));
        }

        return mysqli_fetch_assoc($result);
    }

    public function getProductsByIds($ids){

        if(empty($ids)){
            return [];
        }

        $connection = $this->connection();
        $ids = array_map('intval', $ids);
        $idList = implode(',', $ids);

        $sql = "SELECT * FROM products WHERE id IN ($idList) AND is_available = 1";
        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Cart Product Query Failed: " . mysqli_error($connection));
        }

        $products = [];
        while($row = mysqli_fetch_assoc($result)){
            $products[$row['id']] = $row;
        }

        return $products;
    }

    public function decrementStock($id, $quantity){

        $connection = $this->connection();
        $id = intval($id);
        $quantity = intval($quantity);

        $sql = "UPDATE products
                SET stock_qty = stock_qty - $quantity
                WHERE id = $id AND stock_qty >= $quantity";

        return mysqli_query($connection, $sql) && mysqli_affected_rows($connection) === 1;
    }

    public function getAverageRating($id){

        $connection = $this->connection();
        $tableCheck = mysqli_query($connection, "SHOW TABLES LIKE 'reviews'");

        if(!$tableCheck || mysqli_num_rows($tableCheck) === 0){
            return null;
        }

        $id = intval($id);
        $result = mysqli_query($connection, "SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = $id");
        $row = $result ? mysqli_fetch_assoc($result) : null;

        return $row && $row['avg_rating'] !== null ? round($row['avg_rating'], 1) : null;
    }
}
?>
