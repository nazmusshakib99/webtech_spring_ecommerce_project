<?php

require_once "../Model/productModel.php";

$product = new ProductModel();

if(isset($_GET['id'])){

    $id = intval($_GET['id']); 

    $singleProduct = $product->getProductById($id);

    if($singleProduct){
        include "../View/productView.php";
    }else{
        echo "Product not found";
    }

}else{
    echo "No product selected";
}
?>