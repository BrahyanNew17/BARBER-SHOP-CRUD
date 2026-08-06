<?php
class Database
{
    private $host = "127.0.0.1";
    private $db_name = "barber_shop";
    private $username = "root";
    private $password = "";
    public $conn;
    private $port = "3306";

    public function getConnection()
    {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username,
            $this->password);
            $this->conn->exec("set names utf8");
            //echo "Conexion exitosa a la base de datos.";
        } catch(PDOException $exception){
            echo "Error de conexion: " . $exception->getMessage();
        }
        return $this->conn;

    }
}