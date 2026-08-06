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
$query="INSERT INTO " . $this->table . " (NITproveedor, nombreProveedor, direcProveedor, telefono) VALUES(?, ?, ?, ?)";
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

public function eliminar($nombreProveedor)
{
    // Primero obtener el NITproveedor para borrar dependientes
    $stmt = $this->conn->prepare("SELECT NITproveedor FROM proveedor WHERE nombreProveedor = ?");
    $stmt->execute([$nombreProveedor]);
    $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proveedor) {
        $nit = $proveedor['NITproveedor'];
        // Borrar proveedorproducto dependientes
        $this->conn->prepare("DELETE FROM proveedorproducto WHERE NITproveedor = ?")->execute([$nit]);
    }

    // Ahora sí borrar el proveedor
    $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE nombreProveedor = ?");
    $stmt->execute([$nombreProveedor]);
}

public function actualizar($NITproveedor, $nombreProveedor, $direcProveedor, $telefono)
{
    $query = "UPDATE " . $this->table . " SET nombreProveedor = ?, direcProveedor = ?, telefono = ? WHERE NITproveedor = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$nombreProveedor, $direcProveedor, $telefono, $NITproveedor]);
}
}