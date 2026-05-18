<?php

require_once "../Model/productModel.php";

$product = new ProductModel();


if(isset($_GET['id'])){

    $id = $_GET['id'];

    $products = $product->getProductsByCategory($id);

    include "../View/categoryView.php";


}else{
    echo "No data found";
}

?>