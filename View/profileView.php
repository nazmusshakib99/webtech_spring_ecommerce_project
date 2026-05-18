<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php");
    exit();
}

require_once "../Model/profileModel.php";

$model = new ProfileModel();
$user = $model->getUserById($_SESSION['user_id']);


$addresses = json_decode($user['shipping_addresses'], true);


if(isset($addresses[0])){
    $address1 = $addresses[0];
} else {
    $address1 = "";
}

if(isset($addresses[1])){
    $address2 = $addresses[1];
} else {
    $address2 = "";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
<link rel="stylesheet" href="Style/profileStyle.css">
</head>
<body>
<!-- HEADER -->
<div class="top-header">
    <div class="logo">ShopEasy</div>
    <div class="menu">
        <a href="../index.php">Home</a>
        <a href="../Controller/logout.php">Logout</a>
    </div>
</div>
<!-- PROFILE CARD -->
<div style="display:flex; flex-direction:column; align-items:center; gap:20px;">
<!-- MESSAGE -->
     <div style="text-align:center;">
        <?php if(isset($_GET['success'])){ ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
        <?php if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    </div>
 <!-- PROFILE UPDATE -->
<div class="profile-container">
<h2>My Profile</h2>
<form action="../Controller/profileValidation.php" method="POST">

            <label>Name</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $user['phone']; ?>">

            <label>Shipping Address 1</label>
            <textarea name="address1"><?php echo $address1; ?></textarea>

            <label>Shipping Address 2</label>
            <textarea name="address2"><?php echo $address2; ?></textarea>

            <button type="submit" name="updateProfile">Update Profile</button>
 </form>
</div>
 <!-- PASSWORD CHANGE -->
    <div class="profile-container">

        <h2>Change Password</h2>

        <form action="../Controller/profileValidation.php" method="POST">

            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <label>New Password</label>
            <input type="password" name="new_password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="changePassword">Change Password</button>

        </form>

    </div>

</div>

</body>
</html>