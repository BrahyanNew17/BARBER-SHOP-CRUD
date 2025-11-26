<?php
class insertServicioModel
{
    private $conn;
    private $table='servicio';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertServicio($nombreServi, $precioUni, $duracion)
{
$query="INSERT INTO " . $this->table . "(nombreServi, precioUni, duracion) VALUES(?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$nombreServi, $precioUni, $duracion]);
}
}