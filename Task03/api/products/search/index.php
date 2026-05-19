<?php

require_once __DIR__ . "/../../../Model/productModel.php";

header('Content-Type: application/json');

$model = new ProductModel();
$keyword = $_GET['q'] ?? '';
$result = $keyword === '' ? $model->getAllProducts() : $model->searchProducts($keyword);

$products = [];
while($row = mysqli_fetch_assoc($result)){
    $products[] = $row;
}

echo json_encode(['products' => $products]);

?>
