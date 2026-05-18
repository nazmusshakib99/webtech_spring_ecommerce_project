<?php
require_once "../Model/productModel.php";

$id = $_GET['id'] ?? 0;

$model = new ProductModel();
$product = $model->getProductById($id);

if(!$product){
    echo "Product not found";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $product['name']; ?></title>

<link rel="stylesheet" href="../View/Style/homeStyle.css">
<link rel="stylesheet" href="../View/Style/productStyle.css">

</head>

<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<div class="product-container">

<div class="product-image">
<img src="../uploads/<?php echo $product['image']; ?>">
</div>

<div class="product-details">

<h2><?php echo $product['name']; ?></h2>

<p class="price">$<?php echo $product['price']; ?></p>

<p>Available Stock: <?php echo $product['stock_qty']; ?></p>

<p class="description">
<?php echo $product['description']; ?>
</p>

<div class="action-buttons">

<form action="../Controller/cartController.php" method="POST">
<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
<button class="cart-btn">🛒 Add To Cart</button>
</form>

<form action="../Controller/productValidation.php" method="GET">
<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
<button class="buy-btn">⚡ Buy Now</button>
</form>

</div>

</div>
</div>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>