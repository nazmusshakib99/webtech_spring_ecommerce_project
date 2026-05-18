<?php

require_once "db.php";

class ProductModel extends Database {

    public function getAllProducts(){

        $connection = $this->connection();

        $sql = "SELECT * FROM products";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Product Query Failed: " . mysqli_error($connection));
        }
  return $result;
    }
public function searchProducts($keyword){

        $connection = $this->connection();

        $sql = "SELECT * FROM products 
                WHERE name LIKE '%$keyword%'";

        return mysqli_query($connection, $sql);
    }
     public function getProductsByCategory($id){

        $connection = $this->connection();

        $sql = "SELECT * FROM products WHERE category_id='$id'";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Category Product Query Failed: " . mysqli_error($connection));
        }

        return $result;
    }

    public function getProductById($id){

        $connection = $this->connection();

        $sql = "SELECT * FROM products WHERE id='$id'";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Single Product Query Failed: " . mysqli_error($connection));
        }

        return mysqli_fetch_assoc($result);
    }
}
?>