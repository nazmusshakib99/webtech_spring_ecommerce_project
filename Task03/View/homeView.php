<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once "../Model/categoryModel.php";
require_once "../Model/productModel.php";

$categoryModel = new CategoryModel();
$productModel = new ProductModel();
$categories = $categoryModel->getAllCategories();
$categoryOptions = $categoryModel->getAllCategories();
$selectedCategory = $_GET['id'] ?? '';
$searchKeyword = trim($_GET['q'] ?? '');

if($searchKeyword !== ''){
    $products = $productModel->searchProducts($searchKeyword);
} else {
    $products = $selectedCategory ? $productModel->getProductsByCategory($selectedCategory) : $productModel->getAllProducts();
}
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

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<?php if(!isset($_SESSION['user_id']) && !$selectedCategory){ ?>
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

<?php if(!$selectedCategory){ ?>
<div class="category-section">
<h2 class="section-title">Shop By Category</h2>

<div class="categories">
<?php while($row = mysqli_fetch_assoc($categories)){ ?>
<div class="category-card">
<a href="homeView.php?id=<?php echo $row['id']; ?>">
<img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
<h3><?php echo htmlspecialchars($row['name']); ?></h3>
</a>
</div>
<?php } ?>
</div>
</div>
<?php } ?>

<div class="product-section">
<h2 class="section-title">
<?php echo $searchKeyword !== '' ? 'Search Results for "' . htmlspecialchars($searchKeyword) . '"' : 'Available Products'; ?>
</h2>

<div class="catalogue-toolbar">
<label for="category-filter">Category</label>
<select id="category-filter">
<option value="">All Categories</option>
<?php while($category = mysqli_fetch_assoc($categoryOptions)){ ?>
<option value="<?php echo $category['id']; ?>" <?php echo strval($selectedCategory) === strval($category['id']) ? 'selected' : ''; ?>>
<?php echo htmlspecialchars($category['name']); ?>
</option>
<?php } ?>
</select>
</div>

<div class="products" id="product-grid">
<?php while($row = mysqli_fetch_assoc($products)){ ?>
<div class="product-card">
<a href="../Controller/productValidation.php?id=<?php echo $row['id']; ?>">
<img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
<h3><?php echo htmlspecialchars($row['name']); ?></h3>
<p>$<?php echo number_format($row['price'], 2); ?></p>
</a>
<button class="cart-btn ajax-add-cart" data-product-id="<?php echo $row['id']; ?>">Add to Cart</button>
</div>
<?php } ?>
</div>
</div>

</div>

<?php if(!$selectedCategory){ ?>
<div class="footer">
<h3>E-Commerce Store Management System</h3>
<p>Developed Using PHP & MySQL</p>
</div>
<?php } ?>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
