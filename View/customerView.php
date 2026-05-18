<?php
session_start();

// PROTECT PAGE (must login)
if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Customer Dashboard</title>

<link rel="stylesheet" href="/Webtech_Spring_25-26-_F/Webtech_Project/E-Commerce_Store_Management_System/View/Style/homeStyle.css">


</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="logo">
        <a href="../index.php" style="color:#ff9900;text-decoration:none;">
            ShopEasy
        </a>
    </div>

    <div class="menu">
        <span style="color:#ff9900;">Hello, <?php echo $_SESSION['name']; ?></span>

        <a href="profile.php">My Profile</a>
        <a href="orders.php">My Orders</a>
        <a href="../Controller/cartController.php">Cart</a>
        <a href="../Controller/logout.php">Logout</a>
    </div>

</div>


<!-- DASHBOARD SECTION -->
<div style="padding:40px;">

    <h2>Customer Dashboard</h2>
    <p>Welcome back, <?php echo $_SESSION['name']; ?> 👋</p>

    <div style="margin-top:30px; display:flex; gap:20px; flex-wrap:wrap;">

        <a href="profile.php" style="padding:20px; background:#fff; border-radius:10px; text-decoration:none; color:black; box-shadow:0 0 10px rgba(0,0,0,0.1);">
            👤 My Profile
        </a>

        <a href="orders.php" style="padding:20px; background:#fff; border-radius:10px; text-decoration:none; color:black; box-shadow:0 0 10px rgba(0,0,0,0.1);">
            📦 My Orders
        </a>

        <a href="../Controller/cartController.php" style="padding:20px; background:#fff; border-radius:10px; text-decoration:none; color:black; box-shadow:0 0 10px rgba(0,0,0,0.1);">
            🛒 Cart
        </a>

    </div>

</div>


<!-- OPTIONAL: SHOW PRODUCTS -->
<div class="product-section">
<h2 class="section-title">Recommended Products</h2>

<div class="products">

<?php
require_once "../Model/productModel.php";
$product = new ProductModel();
$products = $product->getAllProducts();

while($row = mysqli_fetch_assoc($products)){
?>

<div class="product-card">

<a href="../Controller/productController.php?id=<?php echo $row['id']; ?>">

<img src="../uploads/<?php echo $row['image']; ?>">

<div class="product-info">
<h3><?php echo $row['name']; ?></h3>
<p class="price">$<?php echo $row['price']; ?></p>
</div>

</a>

</div>

<?php } ?>

</div>
</div>


<!-- FOOTER -->
<div class="footer">
<h3>Customer Panel</h3>
<p>Welcome to your dashboard</p>
</div>

</body>
</html>