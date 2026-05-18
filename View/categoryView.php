<!DOCTYPE html>
<html>
<head>

<title>Category Products</title>

<link rel="stylesheet" href="/Webtech_Spring_25-26-_F/Webtech_Project/E-Commerce_Store_Management_System/View/Style/productStyle.css">

</head>

<body>

<div class="product-section">

<h2 class="section-title">Category Products</h2>

<div class="products">

<?php while($row = mysqli_fetch_assoc($products)){ ?>

<div class="product-card">

<a href="../Controller/productValidation.php?id=<?php echo $row['id']; ?>">

<img src="../uploads/<?php echo $row['image']; ?>">

<div class="product-info">
<h3><?php echo $row['name']; ?></h3>
<p class="price">$<?php echo $row['price']; ?></p>
</div>

</a>

<form action="../Controller/cartController.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <button type="submit">Add To Cart</button>
</form>

</div>

<?php } ?>

</div>

</div>

</body>
</html>