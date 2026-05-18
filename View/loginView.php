
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link rel="stylesheet" href="Style/loginStyle.css">
</head>

<body>

<div class="login-container">

<h2>Login</h2>

<?php if(isset($_GET['error'])){ ?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>

<form action="../Controller/loginValidation.php" method="POST">

<input type="text" name="username" placeholder="Username" required>

<div class="password-box">
<input type="password" name="password" id="password" placeholder="Password" required>
<span onclick="togglePassword()">👁️</span>
</div>

<label>
<input type="checkbox" name="remember"> Remember Me
</label>

<button type="submit" name="login">Login</button>

</form>

<p>Don't have an account? <a href="signupView.php">Sign up</a></p>

</div>

<script>
function togglePassword(){

    var pass = document.getElementById("password");

    if(pass.type === "password"){
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</body>
</html>