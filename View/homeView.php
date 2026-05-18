<?php
session_start();

require_once "../Model/categoryModel.php";

$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();

$category_id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
<title>ShopEasy</title>

<link rel="stylesheet" href="Style/homeStyle.css">
<link rel="stylesheet" href="Style/categoryStyle.css">
<link rel="stylesheet" href="Style/productStyle.css">

</head>

<body>

<div class="main-content">

<div class="header">

<div class="logo">
<a href="homeView.php" style="color:#ff9900;text-decoration:none;">
ShopEasy
</a>
</div>

<div class="search-box">
<div class="search-input-wrapper">
<input type="text" id="search" placeholder="Search Products" onkeyup="liveSearch(this.value)">
<div id="suggestions"></div>
</div>
<button >Search</button> 
</div>


<div class="menu">

<?php if(isset($_SESSION['user_id'])){ ?>

<span style="color:#ff9900;">Welcome, <?php echo $_SESSION['name']; ?> 👋</span>

<a href="../View/profileView.php">👤 Profile</a>
<a href="../View/orders.php">📦 Orders</a>
<a href="../Controller/cartController.php">🛒 Cart</a>
<a href="../Controller/logout.php">🚪 Logout</a>

<?php } else { ?>

<a href="../View/loginView.php">🔑 Login</a>
<a href="../View/signupView.php">📝 Sign Up</a>
<a href="../Controller/cartController.php">🛒 Cart</a>

<?php } ?>

</div>
</div>

<!-- NAVBAR -->
<div class="navbar">
<a href="homeView.php">Home</a>
<a href="homeView.php?id=1">Smartphone</a>
<a href="homeView.php?id=2">Electronics</a>
<a href="homeView.php?id=3">Fashion</a>
<a href="homeView.php?id=4">Books</a>
<a href="homeView.php?id=5">Sports</a>
<a href="homeView.php?id=6">Beauty</a>
<a href="homeView.php?id=7">Baby Care</a>
<a href="homeView.php?id=8">Kitchen Appliances</a>
</div>


<?php if(!isset($_SESSION['user_id']) && !$category_id){ ?>
<div class="hero">
<div class="hero-content">
<h1>Welcome To ShopEasy</h1>
<p>Best Products With Best Prices</p>
<a href="../View/loginView.php">
<button>Shop Now</button>
</a>
</div>
</div>
<?php } ?>

<!-- CATEGORY -->
<?php if(!$category_id){ ?>
<div class="category-section">
<h2 class="section-title">Shop By Category</h2>

<div class="categories">
<?php while($row = mysqli_fetch_assoc($categories)){ ?>
<div class="category-card">
<a href="homeView.php?id=<?php echo $row['id']; ?>">
<img src="../uploads/<?php echo $row['image']; ?>">
<h3><?php echo $row['name']; ?></h3>
</a>
</div>
<?php } ?>
</div>
</div>
<?php } ?>


<?php if($category_id){ ?>

<?php
require_once "../Model/productModel.php";
$productModel = new ProductModel();
$products = $productModel->getProductsByCategory($category_id);
?>

<div class="product-section">
<h2 class="section-title">Products</h2>

<div class="products">

<?php while($row = mysqli_fetch_assoc($products)){ ?>
<div class="product-card">
<a href="../Controller/productValidation.php?id=<?php echo $row['id']; ?>">
<img src="../uploads/<?php echo $row['image']; ?>">
<h3><?php echo $row['name']; ?></h3>
<p>$<?php echo $row['price']; ?></p>
</a>
</div>
<?php } ?>

</div>
</div>

<?php } ?>

</div> 


<?php if(!$category_id){ ?>
<div class="footer">
<h3>E-Commerce Store Management System</h3>
<p>Developed Using PHP & MySQL</p>
</div>
<?php } ?>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>