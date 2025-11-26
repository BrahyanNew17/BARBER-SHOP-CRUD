<?php
class insertProveedorModel
{
private $conn;
private $table='proveedor';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertProveedor($NITproveedor, $nombreProveedor, $direcProveedor, $telefono)
{
$query="INSERT INTO " . $this->table . "(NITproveedor, nombreProveedor, direcProveedor, telefono) VALUES(?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$NITproveedor, $nombreProveedor, $direcProveedor, $telefono]);
}

public function getProveedores()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getProveedorByName($nombreProveedor)
{
    $query = "SELECT * FROM " . $this->table . " WHERE nombreProveedor LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $nombreProveedor . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
}
