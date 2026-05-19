<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php?error=Please login first");
    exit();
}

require_once "../Model/orderModel.php";

$model = new OrderModel();
$orders = $model->getOrdersByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>
<link rel="stylesheet" href="Style/homeStyle.css">
<link rel="stylesheet" href="Style/cartStyle.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<main class="cart-page">
<h2>My Orders</h2>

<?php if(empty($orders)){ ?>
<div class="cart-empty">
<p>No orders yet.</p>
<a href="homeView.php">Start Shopping</a>
</div>
<?php } else { ?>
<div class="cart-table">
<div class="cart-row cart-heading">
<span>Order</span>
<span>Date</span>
<span>Status</span>
<span>Total</span>
<span>Action</span>
</div>
<?php foreach($orders as $order){ ?>
<div class="cart-row">
<span>#<?php echo $order['id']; ?></span>
<span><?php echo htmlspecialchars($order['created_at']); ?></span>
<span><?php echo htmlspecialchars($order['status']); ?></span>
<span>$<?php echo number_format($order['total_amount'], 2); ?></span>
<span><a href="orderConfirmationView.php?id=<?php echo $order['id']; ?>">View</a></span>
</div>
<?php } ?>
</div>
<?php } ?>
</main>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
