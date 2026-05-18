
<?php
session_start();

// Not logged home
if(!isset($_SESSION['user_id'])){
    header("Location: View/homeView.php");
    exit();
}

// Admin Page
if($_SESSION['role'] === 'admin'){
    header("Location: View/adminView.php");
} else {
    header("Location: View/homeView.php");
}

exit();
