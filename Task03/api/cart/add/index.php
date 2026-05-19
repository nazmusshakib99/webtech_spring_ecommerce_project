<?php

require_once __DIR__ . "/../../../Controller/cartHelpers.php";

ensureCartStarted();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    sendJson(['success' => false, 'message' => 'POST required'], 405);
}

$productId = intval($_POST['product_id'] ?? 0);
$model = new ProductModel();
$product = $model->getProductById($productId);

if(!$product){
    sendJson(['success' => false, 'message' => 'Product not found'], 404);
}

$stock = intval($product['stock_qty']);
if($stock <= 0){
    sendJson(['success' => false, 'message' => 'Product is out of stock'], 400);
}

$currentQty = intval($_SESSION['cart'][$productId] ?? 0);
$_SESSION['cart'][$productId] = min($stock, $currentQty + 1);

sendJson([
    'success' => true,
    'cart_count' => getCartCount(),
    'quantity' => $_SESSION['cart'][$productId]
]);

?>
