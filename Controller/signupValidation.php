<?php
session_start();
require_once('../Model/signupModel.php');

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

$model = new SignupModel();

$errors = [];



if(empty($name)){
    $errors['name'] = "Name required";
}
elseif(!preg_match("/^[a-zA-Z ]+$/", $name)){
    $errors['name'] = "Only letters allowed";
}

if(strlen($username) < 5){
    $errors['username'] = "Min 5 characters";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Invalid email";
}

if(strlen($password) < 5){
    $errors['password'] = "Min 8 characters";
}

if($password !== $confirm){
    $errors['confirm'] = "Passwords do not match";
}

if($model->checkUsername($username) > 0){
    $errors['username'] = "Username already exists";
}

if($model->checkEmail($email) > 0){
    $errors['email'] = "Email already exists";
}


if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;

    header("Location: ../View/signupView.php");
    exit();
}


$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$model->insertUser($name, $username, $email, $phone, $passwordHash);

header("Location: ../View/loginView.php");