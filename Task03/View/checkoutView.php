<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php?error=Please login before checkout");
    exit();
}

require_once "../Controller/cartHelpers.php";
require_once "../Model/profileModel.php";

$cart = getCartDetails();
$profileModel = new ProfileModel();
$user = $profileModel->getUserById($_SESSION['user_id']);
$addresses = json_decode($user['shipping_addresses'], true) ?? [];
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="Style/homeStyle.css">
<link rel="stylesheet" href="Style/cartStyle.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<main class="checkout-page">
<h2>Checkout</h2>

<?php if(isset($_GET['error'])){ ?>
<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php } ?>

<?php if(empty($cart['items'])){ ?>
<div class="cart-empty">
<p>Your cart is empty.</p>
<a href="homeView.php">Continue Shopping</a>
</div>
<?php } else { ?>

<form action="../Controller/checkoutController.php" method="POST" class="checkout-layout">
<div>
<section class="checkout-section">
<h3>Shipping Address</h3>

<?php foreach($addresses as $index => $address){
    if(trim($address) === ''){
        continue;
    }
?>
<label>
<input type="radio" name="address_choice" value="<?php echo $index; ?>" <?php echo $index === 0 ? 'checked' : ''; ?>>
<?php echo htmlspecialchars($address); ?>
</label>
<?php } ?>

<label>
<input type="radio" name="address_choice" value="new" <?php echo empty($addresses) ? 'checked' : ''; ?>>
Use a new address
</label>
<textarea name="new_address" placeholder="Enter a new shipping address"></textarea>
</section>

<section class="checkout-section">
<h3>Payment Method</h3>
<label><input type="radio" name="payment_method" value="Cash" checked> Cash</label>
<label><input type="radio" name="payment_method" value="Card"> Card</label>
</section>

<button type="submit" name="place_order">Place Order</button>
</div>

<aside class="checkout-summary">
<h3>Order Summary</h3>
<?php foreach($cart['items'] as $item){ ?>
<div class="summary-item">
<span><?php echo htmlspecialchars($item['product']['name']); ?> x <?php echo $item['quantity']; ?></span>
<strong>$<?php echo number_format($item['line_total'], 2); ?></strong>
</div>
<?php } ?>
<div class="summary-item">
<span>Total</span>
<strong>$<?php echo number_format($cart['grand_total'], 2); ?></strong>
</div>
</aside>
</form>

<?php } ?>
</main>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
