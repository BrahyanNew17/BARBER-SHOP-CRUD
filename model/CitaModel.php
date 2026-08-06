<?php

class CitaModel {
    private $conn;
    private $table = 'cita';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCita(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>