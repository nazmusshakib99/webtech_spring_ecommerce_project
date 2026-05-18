<?php

require_once('../Model/signupModel.php');

$model = new SignupModel();


if(isset($_POST['email'])){
    $email = $_POST['email'];
} else {
    $email = "";
}


if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<span style='color:red;'>Invalid</span>";
    exit();
}


$result = $model->checkEmail($email);

if($result > 0){
    echo "<span style='color:red;'>Email exists</span>";
} else {
    echo "<span style='color:green;'>OK</span>";
}

?>