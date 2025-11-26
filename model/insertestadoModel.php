<?php
class insertestadoModel
{
    private $conn;
    private $table = 'estado';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertestado($estado)
    {
        $query = "INSERT INTO " . $this->table . " (estado) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
[$estado]);
    }
}