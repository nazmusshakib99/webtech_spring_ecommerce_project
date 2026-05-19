<?php

session_start();

require_once "cartHelpers.php";
require_once "../Model/profileModel.php";
require_once "../Model/orderModel.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../View/loginView.php?error=Please login before checkout");
    exit();
}

if(!isset($_POST['place_order'])){
    header("Location: ../View/checkoutView.php");
    exit();
}

$cart = getCartDetails();

if(empty($cart['items'])){
    header("Location: ../View/checkoutView.php?error=Your cart is empty");
    exit();
}

$profileModel = new ProfileModel();
$user = $profileModel->getUserById($_SESSION['user_id']);
$addresses = json_decode($user['shipping_addresses'], true) ?? [];
$addressChoice = $_POST['address_choice'] ?? '';
$shippingAddress = '';

if($addressChoice === 'new'){
    $shippingAddress = trim($_POST['new_address'] ?? '');
} elseif($addressChoice !== '' && isset($addresses[intval($addressChoice)])){
    $shippingAddress = trim($addresses[intval($addressChoice)]);
}

if($shippingAddress === ''){
    header("Location: ../View/checkoutView.php?error=Please select or enter a shipping address");
    exit();
}

$paymentMethod = $_POST['payment_method'] ?? 'Cash';
if(!in_array($paymentMethod, ['Cash', 'Card'])){
    header("Location: ../View/checkoutView.php?error=Invalid payment method");
    exit();
}

$orderItems = [];
foreach($cart['items'] as $item){
    $product = $item['product'];

    if($item['quantity'] > intval($product['stock_qty'])){
        header("Location: ../View/checkoutView.php?error=Insufficient stock for " . urlencode($product['name']));
        exit();
    }

    $orderItems[] = [
        'product_id' => $product['id'],
        'quantity' => $item['quantity'],
        'unit_price' => $product['price']
    ];
}

$orderModel = new OrderModel();
$orderId = $orderModel->createOrder($_SESSION['user_id'], $shippingAddress, $paymentMethod, $orderItems, $cart['grand_total']);

if(!$orderId){
    header("Location: ../View/checkoutView.php?error=Unable to place order. Please check stock and try again");
    exit();
}

$_SESSION['cart'] = [];

header("Location: ../View/orderConfirmationView.php?id=" . $orderId);
exit();

?>
