<?php 
session_start();

$error = $_SESSION['error'] ?? '';
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];


unset($_SESSION['error']);
unset($_SESSION['old']);
unset($_SESSION['errors']);
 ?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="Style/SignupStyle.css">
<script src="../Controller/JS/signupAjax.js"></script> 

<title>Signup</title>

</head>

<body>

<div class="signup-container">

<h2>Create Account</h2>


<span class="error">
<?php echo $_SESSION['error'] ?? '' ?>
</span>

<form method="post" action="../Controller/signupValidation.php">


<input type="text" name="name" placeholder="Full Name"
value="<?php echo $_SESSION['old']['name'] ?? '' ?>">
<span class="error"><?php echo $_SESSION['errors']['name'] ?? '' ?></span>


<input type="text" id="username" name="username"
placeholder="Username"
onkeyup="checkUsername()"
value="<?php echo $_SESSION['old']['username'] ?? '' ?>">
<p id="usernameMsg"></p>


<input type="email" id="email" name="email"
placeholder="Email"
onkeyup="checkEmail()"
value="<?php echo $_SESSION['old']['email'] ?? '' ?>">
<p id="emailMsg"></p>


<input type="text" name="phone" placeholder="Phone"
value="<?php echo $_SESSION['old']['phone'] ?? '' ?>">


<div class="password-box">
    <input type="password" id="password" name="password" placeholder="Password">
    <span onclick="togglePassword('password')">👁️</span>
</div>
<span class="error"><?php echo $_SESSION['errors']['password'] ?? '' ?></span>


<div class="password-box">
    <input type="password" id="confirm" name="confirm_password" placeholder="Confirm Password">
    <span onclick="togglePassword('confirm')">👁️</span>
</div>
<span class="error"><?php echo $_SESSION['errors']['confirm'] ?? '' ?></span>

<button type="submit">Sign Up</button>

</form>

</div>

</body>
</html>