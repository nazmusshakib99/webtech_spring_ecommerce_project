<?php

require_once "db.php";

class CategoryModel extends Database {

    public function getAllCategories(){

        $connection = $this->connection();

        $sql = "SELECT * FROM categories";

        $result = mysqli_query($connection, $sql);

        if(!$result){
            die("Category Query Failed: " . mysqli_error($connection));
        }

        return $result;
    }
}