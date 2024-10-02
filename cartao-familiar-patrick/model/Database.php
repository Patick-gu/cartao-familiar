<?php

class Database
{
    public $db_encrypt = "FAMILYCARD";
    private $host = "localhost";
    private $db_name = "cartao_familiar";
    private $username = "root";
    private $password = "098zxc123";
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }


}
$obj = new Database;
$obj->connect();