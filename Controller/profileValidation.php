<?php
session_start();
require_once "../Model/profileModel.php";

$model = new ProfileModel();
$id = $_SESSION['user_id'];
$user = $model->getUserById($id);
if(isset($_POST['updateProfile'])){
 $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

   
  $addresses = [];

if(isset($_POST['address1'])){
    $addresses[0] = $_POST['address1'];
} else {
    $addresses[0] = "";
}

if(isset($_POST['address2'])){
    $addresses[1] = $_POST['address2'];
} else {
    $addresses[1] = "";
}

    $model->updateProfile($id, $name, $username, $email, $phone, $addresses);

    header("Location: ../View/profileView.php?success=Profile updated successfully");
    exit();
}

if(isset($_POST['changePassword'])){

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

  
    if(password_verify($current, $user['password_hash'])){

       
        if($new !== $confirm){
            header("Location: ../View/profileView.php?error=Passwords do not match");
            exit();
        }

       
        if(strlen($new) < 8){
            header("Location: ../View/profileView.php?error=Password must be at least 8 characters");
            exit();
        }

        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $model->updatePassword($id, $newHash);

        header("Location: ../View/profileView.php?success=Password updated successfully");
        exit();

    } else {
        header("Location: ../View/profileView.php?error=Wrong current password");
        exit();
    }
}
?>