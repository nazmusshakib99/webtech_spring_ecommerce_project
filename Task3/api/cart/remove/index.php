<?php

require_once __DIR__ . "/../../../Controller/cartHelpers.php";

ensureCartStarted();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    sendJson(['success' => false, 'message' => 'POST required'], 405);
}

$productId = intval($_POST['product_id'] ?? 0);
unset($_SESSION['cart'][$productId]);

$cart = getCartDetails();

sendJson([
    'success' => true,
    'product_id' => $productId,
    'grand_total' => number_format($cart['grand_total'], 2, '.', ''),
    'cart_count' => $cart['count']
]);

?>
