<?php
require_once "db.php";

class AdminModel extends Database{

    
    public function getAllProducts(){
        $conn = $this->connection();
        return mysqli_query($conn, "SELECT * FROM products");
    }

    public function getProductById($id){
        $conn = $this->connection();
        $id = intval($id);

        $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
        return mysqli_fetch_assoc($res);
    }

  
    public function getCategories(){
        $conn = $this->connection();
        return mysqli_query($conn, "SELECT * FROM categories");
    }


    

    public function addProduct($data){
        $conn = $this->connection();

        $sql = "INSERT INTO products 
        (name, description, price, stock_qty, category_id, image, is_available)
        VALUES 
        ('{$data['name']}', '{$data['description']}', '{$data['price']}', 
        '{$data['stock']}', '{$data['category_id']}', '{$data['image']}', 1)";

        mysqli_query($conn, $sql);
    }

  
    public function updateProduct($data){

        $conn = $this->connection();
        $id = intval($data['id']);

        $imageSQL = "";

        if(isset($data['image'])){
            $imageSQL = ", image='{$data['image']}'";
        }

        $sql = "UPDATE products SET 
                name='{$data['name']}',
                description='{$data['description']}',
                price='{$data['price']}',
                stock_qty='{$data['stock']}',
                category_id='{$data['category_id']}'
                $imageSQL
                WHERE id=$id";

        mysqli_query($conn, $sql);
    }


    public function toggleStock($id){
        $conn = $this->connection();
        mysqli_query($conn, "UPDATE products SET is_available = NOT is_available WHERE id=$id");
    }

 
public function deleteProduct($id){

    $conn = $this->connection();

    $id = intval($id);

    $check = mysqli_query($conn, 
        "SELECT * FROM order_items WHERE product_id=$id"
    );

    if(mysqli_num_rows($check) > 0){
        return false;
    }

    $delete = mysqli_query($conn, 
        "DELETE FROM products WHERE id=$id"
    );

    if($delete){
        return true;
    }

    return false;
}

   
}
?>