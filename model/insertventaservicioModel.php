<?php
class insertventaservicioModel
{
private $conn;
private $table='ventaservicio';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertventaservicio($fecha, $hora, $numDocum, $total)
{
$query="INSERT INTO " . $this->table . " (fecha, hora, numDocum, total) VALUES(?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$fecha, $hora, $numDocum, $total]);
}

//Metodo para obtener todos los servicios
public function getventaservicio()
{
        $query = "SELECT 
        
        vs.idVentaServi AS idVentaServi,
                vs.fecha AS fecha,
                vs.hora AS hora,
                vs.numDocum AS numDocum,
                vs.total AS total,
                c.nombreComplet AS nombreComplet
              FROM ventaservicio vs
              INNER JOIN cliente c ON vs.numDocum = c.numDocum";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function getventaserviciobyidventaservi($idVentaServi )
{
        $sql = "SELECT 
                vs.idVentaServi AS idVentaServi,
                vs.fecha AS fecha,
                vs.hora AS hora,
                vs.numDocum AS numDocum,
                vs.total AS total,
                c.nombreComplet AS nombreComplet
              FROM ventaservicio vs
              INNER JOIN cliente c ON vs.numDocum = c.numDocum
              WHERE vs.idVentaServi LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $idVentaServi . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function eliminar($idVentaServi)
{
    $query = "DELETE FROM " .$this->table. " WHERE idVentaServi=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$idVentaServi]);

} 

public function actualizar($idVentaServi, $fecha, $hora, $numDocum, $total)
{
    $query = "UPDATE " . $this->table . " SET fecha=?, hora=?, numDocum=?, total=? WHERE idVentaServi=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$fecha, $hora, $numDocum, $total, $idVentaServi]);
}
}
?>