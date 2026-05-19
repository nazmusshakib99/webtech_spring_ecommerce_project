<?php

class Database{

    private string $host = "localhost";
    private string $dbname = "tryproject";
    private string $username = "root";
    private string $password = "";

    public PDO $conn;

    public function __construct(){

        try{

            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        }catch(PDOException $e){

            die("Database Connection Failed: " . $e->getMessage());

        }

    }

}
?>