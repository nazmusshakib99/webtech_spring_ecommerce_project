<?php

require_once __DIR__ . "/../../../Controller/cartHelpers.php";

ensureCartStarted();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    sendJson(['success' => false, 'message' => 'POST required'], 405);
}

$productId = intval($_POST['product_id'] ?? 0);
$action = $_POST['action'] ?? '';

$model = new ProductModel();
$product = $model->getProductById($productId);

if(!$product || !isset($_SESSION['cart'][$productId])){
    sendJson(['success' => false, 'message' => 'Cart item not found'], 404);
}

$quantity = intval($_SESSION['cart'][$productId]);
if($action === 'increase'){
    $quantity++;
} elseif($action === 'decrease'){
    $quantity--;
} else {
    sendJson(['success' => false, 'message' => 'Invalid action'], 400);
}

$quantity = max(1, min($quantity, intval($product['stock_qty'])));
$_SESSION['cart'][$productId] = $quantity;

$lineTotal = $quantity * floatval($product['price']);
$cart = getCartDetails();

sendJson([
    'success' => true,
    'product_id' => $productId,
    'quantity' => $quantity,
    'line_total' => number_format($lineTotal, 2, '.', ''),
    'grand_total' => number_format($cart['grand_total'], 2, '.', ''),
    'cart_count' => $cart['count']
]);

?>
