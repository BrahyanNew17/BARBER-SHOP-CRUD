<?php

class insertTipDocumModel {
    private $conn;
    private $table = 'tipodocumento';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getinsertTipDocum(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertTipDocum($tipo_documento){
        $sql = "INSERT INTO " . $this->table . " (tipoDocumento) VALUES (:nombre)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $tipo_documento);
        return $stmt->execute();
    }
    

    //Metodo para obtener todos los tipos de documento
public function getTipDocum()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>