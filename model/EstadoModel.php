<?php

class EstadoModel {
    private $conn;
    private $table = 'estado';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEstado(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>