<?php
require_once "db.php";

class ProfileModel extends Database {

    public function getUserById($id){
        $conn = $this->connection();
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function updateProfile($id, $name, $username, $email, $phone, $addresses){

        $conn = $this->connection();
        $json = json_encode($addresses);

        $sql = "UPDATE users 
                SET name='$name',
                    username='$username',
                    email='$email',
                    phone='$phone',
                    shipping_addresses='$json'
                WHERE id='$id'";

        return mysqli_query($conn, $sql);
    }

    public function updatePassword($id, $hash){
        $conn = $this->connection();
        $sql = "UPDATE users SET password_hash='$hash' WHERE id='$id'";
        return mysqli_query($conn, $sql);
    }
}
?>