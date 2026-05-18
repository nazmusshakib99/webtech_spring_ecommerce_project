<?php
session_start();
require_once "../Model/loginModel.php";

$model = new LoginModel();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $model->login($username, $password);

if($user){

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if(isset($_POST['remember'])){
        $token = bin2hex(random_bytes(32));
        $model->saveRememberToken($user['id'], $token);
        setcookie("remember_token", $token, time() + (86400 * 30), "/");
    }

    if($user['role'] == 'admin'){
        header("Location: ../View/adminView.php");
        exit();
    } else {
        header("Location: ../View/homeView.php");
        exit();
    }

} else {
    header("Location: ../View/loginView.php?error=Invalid username or password");
    exit();
}
}
?>