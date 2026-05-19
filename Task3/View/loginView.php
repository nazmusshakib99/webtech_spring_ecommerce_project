<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="Style/loginStyle.css">
</head>

<body>

<div class="login-shell">

<div class="login-brand">
<a href="homeView.php">ShopEasy</a>
<p>Sign in to continue shopping, manage your cart, and track your orders.</p>
</div>

<div class="login-container">

<h2>Welcome Back</h2>
<p class="login-subtitle">Use your username and password to access your account.</p>

<?php if(isset($_GET['error'])){ ?>
<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php } ?>

<form action="../Controller/loginValidation.php" method="POST">

<label for="username">Username</label>
<input type="text" id="username" name="username" placeholder="Enter username" required>

<label for="password">Password</label>
<div class="password-box">
<input type="password" name="password" id="password" placeholder="Enter password" required>
<button type="button" onclick="togglePassword()" id="passwordToggle">Show</button>
</div>

<label class="remember-row">
<input type="checkbox" name="remember"> Remember me
</label>

<button type="submit" name="login" class="login-button">Login</button>

</form>

<p class="signup-link">Don't have an account? <a href="signupView.php">Sign up</a></p>

</div>

</div>

<script>
function togglePassword(){
    var pass = document.getElementById("password");
    var toggle = document.getElementById("passwordToggle");
    pass.type = pass.type === "password" ? "text" : "password";
    toggle.innerText = pass.type === "password" ? "Show" : "Hide";
}
</script>

</body>
</html>
