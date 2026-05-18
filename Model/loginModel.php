<?php
require_once "db.php";

class LoginModel extends Database {

public function login($username, $password){

    $connection = $this->connection();

    $username = trim($username);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password_hash'])){
            return $user; 
        }
    }

    return false; 
}


    public function saveRememberToken($user_id, $token){

    $connection = $this->connection();

    $sql = "UPDATE users SET remember_token='$token' WHERE id='$user_id'";
    mysqli_query($connection, $sql);
}


    public function getUserByToken($token){
        $connection = $this->connection();
        $sql = "SELECT * FROM users WHERE remember_token='$token'";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) == 1){
            return mysqli_fetch_assoc($result);
        }
        return false;
    }
}
?>