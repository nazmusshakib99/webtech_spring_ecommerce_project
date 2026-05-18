<?php
require_once('db.php');

class SignupModel {

    private $conn;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->connection();
    }

    public function checkUsername($username){
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    public function checkEmail($email){
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    public function insertUser($name,$username,$email,$phone,$password){
        $role = "customer";

        $sql = "INSERT INTO users(name,username,email,phone,password_hash,role)
                VALUES('$name','$username','$email','$phone','$password','$role')";

        return mysqli_query($this->conn,$sql);
    }
}
?>