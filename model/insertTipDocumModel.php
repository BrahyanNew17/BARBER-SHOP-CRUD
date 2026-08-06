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
public function getByTipo($tipoDocumento)
{
    $query = "SELECT * FROM tipodocumento WHERE tipoDocumento = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$tipoDocumento]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



public function eliminar($tipoDocumento)
{
    $query = "DELETE FROM " .$this->table. " WHERE tipoDocumento=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$tipoDocumento]);

} 


    public function getById($idtipoDoc) {
        $query = "SELECT * FROM " . $this->table . " WHERE idtipoDoc = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idtipoDoc]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($idtipoDoc, $tipoDocumento) {
        $query = "UPDATE " . $this->table . " SET tipoDocumento = ? WHERE idtipoDoc = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$tipoDocumento, $idtipoDoc]);
    }
}
?>