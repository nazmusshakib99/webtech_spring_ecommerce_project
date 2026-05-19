<?php
require_once "../Controller/cartHelpers.php";
$cart = getCartDetails();
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" href="Style/homeStyle.css">
<link rel="stylesheet" href="Style/cartStyle.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<main class="cart-page">
<h2>Your Cart</h2>

<?php if(empty($cart['items'])){ ?>
<div class="cart-empty">
<p>Your cart is empty.</p>
<a href="homeView.php">Continue Shopping</a>
</div>
<?php } else { ?>

<div class="cart-table">
<div class="cart-row cart-heading">
<span>Product</span>
<span>Unit Price</span>
<span>Quantity</span>
<span>Line Total</span>
<span>Action</span>
</div>

<?php foreach($cart['items'] as $item){
    $product = $item['product'];
?>
<div class="cart-row" id="cart-row-<?php echo $product['id']; ?>">
<span class="cart-product">
<img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
<?php echo htmlspecialchars($product['name']); ?>
</span>
<span>$<?php echo number_format($product['price'], 2); ?></span>
<span class="qty-controls">
<button class="cart-update" data-product-id="<?php echo $product['id']; ?>" data-action="decrease">-</button>
<strong id="qty-<?php echo $product['id']; ?>"><?php echo $item['quantity']; ?></strong>
<button class="cart-update" data-product-id="<?php echo $product['id']; ?>" data-action="increase">+</button>
</span>
<span>$<strong id="line-total-<?php echo $product['id']; ?>"><?php echo number_format($item['line_total'], 2); ?></strong></span>
<span><button class="cart-remove" data-product-id="<?php echo $product['id']; ?>">Remove</button></span>
</div>
<?php } ?>
</div>

<section class="cart-total">
<p>Grand Total: $<strong id="grand-total"><?php echo number_format($cart['grand_total'], 2); ?></strong></p>
<a class="checkout-link" href="checkoutView.php">Checkout</a>
</section>

<?php } ?>
</main>

<script src="../Controller/JS/liveSearch.js"></script>
<script src="../Controller/JS/cart.js"></script>

</body>
</html>
