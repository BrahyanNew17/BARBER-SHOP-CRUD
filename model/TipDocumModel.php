<?php

class TipDocumModel {
    private $conn;
    private $table = 'tipodocumento';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTipDocum(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>