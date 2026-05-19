<?php

require_once __DIR__ . "/../Model/productModel.php";

function ensureCartStarted(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
}

function getCartCount(){
    ensureCartStarted();
    return array_sum(array_map('intval', $_SESSION['cart']));
}

function getCartDetails(){
    ensureCartStarted();

    $model = new ProductModel();
    $products = $model->getProductsByIds(array_keys($_SESSION['cart']));
    $items = [];
    $grandTotal = 0;

    foreach($_SESSION['cart'] as $productId => $quantity){
        if(!isset($products[$productId])){
            unset($_SESSION['cart'][$productId]);
            continue;
        }

        $product = $products[$productId];
        $quantity = min(intval($quantity), intval($product['stock_qty']));

        if($quantity <= 0){
            unset($_SESSION['cart'][$productId]);
            continue;
        }

        $_SESSION['cart'][$productId] = $quantity;
        $lineTotal = $quantity * floatval($product['price']);
        $grandTotal += $lineTotal;

        $items[] = [
            'product' => $product,
            'quantity' => $quantity,
            'line_total' => $lineTotal
        ];
    }

    return [
        'items' => $items,
        'grand_total' => $grandTotal,
        'count' => getCartCount()
    ];
}

function sendJson($data, $statusCode = 200){
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

?>
