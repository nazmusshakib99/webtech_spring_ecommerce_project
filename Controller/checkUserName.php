<?php

require_once('../Model/signupModel.php');

$model = new SignupModel();

if(isset($_POST['username'])){
    $username = $_POST['username'];
} else {
    $username = "";
}


if(strlen($username) < 5){
    echo "<span style='color:red;'>Too short</span>";
    exit();
}


$result = $model->checkUsername($username);

if($result > 0){
    echo "<span style='color:red;'>Already taken</span>";
} else {
    echo "<span style='color:green;'>Available</span>";
}

?>