<?php

require_once __DIR__ . "/../../Model/productModel.php";

header('Content-Type: application/json');

$model = new ProductModel();
$categoryId = $_GET['category_id'] ?? '';
$result = $categoryId !== '' ? $model->getProductsByCategory($categoryId) : $model->getAllProducts();

$products = [];
while($row = mysqli_fetch_assoc($result)){
    $products[] = $row;
}

echo json_encode(['products' => $products]);

?>
