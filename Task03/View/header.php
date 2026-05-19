<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . "/../Controller/cartHelpers.php";
$cartCount = getCartCount();
$searchValue = $_GET['q'] ?? '';
?>

<div class="header">

<div class="logo">
<a href="../View/homeView.php" style="color:#ff9900;text-decoration:none;">
ShopEasy
</a>
</div>

<form class="search-box" action="../View/homeView.php" method="GET" onsubmit="return submitTopSearch(event)">
<div class="search-input-wrapper">
<input type="text" id="search" name="q" placeholder="Search Products" value="<?php echo htmlspecialchars($searchValue); ?>" onkeyup="liveSearch(this.value)">
<div id="suggestions"></div>
</div>
<button type="submit">Search</button>
</form>

<div class="menu">

<?php if(isset($_SESSION['user_id'])){ ?>

<span style="color:#ff9900;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>

<a href="../View/profileView.php">Profile</a>
<a href="../View/orders.php">Orders</a>
<a href="../View/cartView.php">Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>
<a href="../Controller/logout.php">Logout</a>

<?php } else { ?>

<a href="../View/loginView.php">Login</a>
<a href="../View/signupView.php">Sign Up</a>
<a href="../View/cartView.php">Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>

<?php } ?>

</div>

</div>
