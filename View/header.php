<?php session_start(); ?>

<div class="header">

<div class="logo">
<a href="../View/homeView.php" style="color:#ff9900;text-decoration:none;">
ShopEasy
</a>
</div>

<!-- SEARCH -->
<div class="search-box">
<div class="search-input-wrapper">
<input type="text" id="search" placeholder="Search Products" onkeyup="liveSearch(this.value)">
<div id="suggestions"></div>
</div>
<button onclick="goSearch()">Search</button>
</div>

<!-- MENU -->
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