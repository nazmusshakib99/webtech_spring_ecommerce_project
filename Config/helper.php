<?php


function start_session(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
}


function require_admin(){

    start_session();

    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
        header("Location: ../View/loginView.php");
        exit();
    }
}

function require_login(){

    start_session();

    if(!isset($_SESSION['user_id'])){
        header("Location: ../View/loginView.php");
        exit();
    }
}
?>