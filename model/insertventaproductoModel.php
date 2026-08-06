<?php
class insertventaproductoModel
{
private $conn;
private $table='ventaproducto';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertventaproducto($fecha, $hora, $total, $numDocum)
{
$query="INSERT INTO " . $this->table . " ( fecha, hora, total, numDocum
) VALUES(?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$fecha, $hora, $total, $numDocum]);
}


public function getventaproductos()
{
        $query = "SELECT 
                vp.idVentaProducto AS idVentaProducto,
                vp.fecha AS fecha,
                vp.hora AS hora,
                vp.total AS total,
                vp.numDocum,
                c.nombreComplet AS nombreComplet
              FROM ventaproducto vp
              INNER JOIN cliente c ON vp.numDocum = c.numDocum";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function getventaproductobyidventaproducto($idVentaProducto)
{
    $sql = "SELECT 
                vp.idVentaProducto,
                vp.fecha,
                vp.hora,
                vp.total,
                vp.numDocum,
                c.nombreComplet
              FROM ventaproducto vp
              LEFT JOIN cliente c ON vp.numDocum = c.numDocum 
              WHERE vp.idVentaProducto = ?"; 

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$idVentaProducto]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function eliminar($idVentaProducto)
{
    
    $this->conn->prepare("DELETE FROM devolucion WHERE idVentaProducto = ?")->execute([$idVentaProducto]);
    $this->conn->prepare("DELETE FROM detalleventproducto WHERE idVentaProducto = ?")->execute([$idVentaProducto]);

    
    $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE idVentaProducto = ?");
    $stmt->execute([$idVentaProducto]);
} 

public function actualizar($idVentaProducto, $fecha, $hora, $numDocum, $total)
{
    $query = "UPDATE " . $this->table . " SET fecha=?, hora=?, numDocum=?, total=? WHERE idVentaProducto=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$fecha, $hora, $numDocum, $total, $idVentaProducto]);
}
}
?>