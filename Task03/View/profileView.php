<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php?error=Please login first");
    exit();
}

// require_once "../Controller/loginAuth.php";
require_once "../Model/profileModel.php";

$model = new ProfileModel();
$user = $model->getUserById($_SESSION['user_id']);

$addresses = json_decode($user['shipping_addresses'], true) ?? [];
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
<link rel="stylesheet" href="Style/profileStyle.css">
</head>

<body>

<div class="profile-container">

<h2>My Profile</h2>

<!-- SUCCESS -->
<?php if(isset($_GET['success'])) { ?>
    <p class="success"><?php echo $_GET['success']; ?></p>
<?php } ?>

<!-- ERROR -->
<?php if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>

<!-- UPDATE PROFILE -->
<form action="../Controller/profileValidation.php" method="POST">

<input type="text" name="name" value="<?php echo $user['name']; ?>" required>
<input type="text" name="username" value="<?php echo $user['username']; ?>" required>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>">

<p class="address-title">Shipping Address</p>

<input type="text" name="address1" placeholder="Address 1"
value="<?php echo $addresses[0] ?? ''; ?>">

<input type="text" name="address2" placeholder="Address 2"
value="<?php echo $addresses[1] ?? ''; ?>">

<button type="submit" name="update">Update Profile</button>

</form>

<hr>

<h3>Change Password</h3>

<form action="../Controller/profileValidation.php" method="POST">

<input type="password" name="current_password" placeholder="Current Password" required>
<input type="password" name="new_password" placeholder="New Password" required>

<button type="submit" name="change_password">Change Password</button>

</form>

</div>

</body>
</html>
