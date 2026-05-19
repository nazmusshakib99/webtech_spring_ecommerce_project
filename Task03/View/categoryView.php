<!DOCTYPE html>
<html>
<head>
<title>Category Products</title>
<link rel="stylesheet" href="../View/Style/homeStyle.css">
<link rel="stylesheet" href="../View/Style/productStyle.css">
</head>
<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<div class="product-section">

<h2 class="section-title">Category Products</h2>

<div class="products" id="product-grid">

<?php while($row = mysqli_fetch_assoc($products)){ ?>

<div class="product-card">
<a href="../Controller/productValidation.php?id=<?php echo $row['id']; ?>">
<img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
<div class="product-info">
<h3><?php echo htmlspecialchars($row['name']); ?></h3>
<p class="price">$<?php echo number_format($row['price'], 2); ?></p>
</div>
</a>
<button class="cart-btn ajax-add-cart" data-product-id="<?php echo $row['id']; ?>">Add To Cart</button>
</div>

<?php } ?>

</div>
</div>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
