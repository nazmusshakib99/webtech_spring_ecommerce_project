<?php

class Database{

    public function connection(){

        $connection = mysqli_connect(
            "localhost",
            "root",
            "",
            "ecommerce_db"
        );

        if(!$connection){

            die("Database Connection Failed");
        }

        return $connection;
    }
}

?>