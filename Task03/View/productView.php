<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once "../Model/productModel.php";

$id = $_GET['id'] ?? 0;

$model = new ProductModel();
$product = $model->getProductById($id);
$averageRating = $model->getAverageRating($id);

if(!$product){
    echo "Product not found";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo htmlspecialchars($product['name']); ?></title>

<link rel="stylesheet" href="../View/Style/homeStyle.css">
<link rel="stylesheet" href="../View/Style/productStyle.css">

</head>

<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<div class="product-container">

<div class="product-image">
<img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
</div>

<div class="product-details">

<h2><?php echo htmlspecialchars($product['name']); ?></h2>

<p class="price">$<?php echo number_format($product['price'], 2); ?></p>

<p class="stock">
<?php echo intval($product['stock_qty']) > 0 ? 'In Stock: ' . intval($product['stock_qty']) : 'Out of Stock'; ?>
</p>

<p class="rating">
Average Rating:
<?php echo $averageRating === null ? 'No ratings yet' : htmlspecialchars($averageRating) . ' / 5'; ?>
</p>

<p class="description">
<?php echo nl2br(htmlspecialchars($product['description'])); ?>
</p>

<div class="action-buttons">

<button class="cart-btn ajax-add-cart" data-product-id="<?php echo $product['id']; ?>" <?php echo intval($product['stock_qty']) <= 0 ? 'disabled' : ''; ?>>
Add To Cart
</button>

<button class="buy-btn ajax-add-cart" data-product-id="<?php echo $product['id']; ?>" data-checkout="1" <?php echo intval($product['stock_qty']) <= 0 ? 'disabled' : ''; ?>>
Buy Now
</button>

</div>

</div>
</div>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
