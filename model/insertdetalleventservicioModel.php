<?php
class insertdetalleventservicioModel
{
    private $conn;
    private $table = 'detalleventservicio';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertdetalleventservicio($precioUnitario, $idServicio, $idVentaServi)
    {
        $query = "INSERT INTO " . $this->table . " (precioUnitario, idServicio, idVentaServi) VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$precioUnitario, $idServicio, $idVentaServi]);
    }

    //Metodo para obtener todos los servicios
    public function getDetalleVentServicio()
    {
        $query = "SELECT 
        dvs.idDetalle,
                
                dvs.precioUnitario,
                dvs.idServicio AS idServicio,
                dvs.idVentaServi AS idVentaServi,
                s.nombreServi AS nombreServi,
                vs.idVentaServi,
                vs.fecha,
                vs.hora,
                vs.numDocum,
                vs.total
              FROM detalleventservicio dvs
              INNER JOIN servicio s ON dvs.idServicio = s.idServicio
              INNER JOIN ventaservicio vs ON dvs.idVentaServi = vs.idVentaServi";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDetalleVentServicioById($idVentaServi)
    {
        $sql = "SELECT 
        dvs.idDetalle,
               dvs.precioUnitario,
                               dvs.idServicio AS idServicio,

                s.nombreServi AS nombreServi,
                vs.idVentaServi,
                vs.fecha,
                vs.hora,
                vs.numDocum,
                vs.total
              FROM detalleventservicio dvs
              INNER JOIN servicio s ON dvs.idServicio = s.idServicio
              INNER JOIN ventaservicio vs ON dvs.idVentaServi = vs.idVentaServi
              WHERE dvs.idVentaServi LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $idVentaServi . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDetalleVentServicioByIdDetalle($idDetalle)
    {
        $sql = "SELECT 
        dvs.idDetalle,
               dvs.precioUnitario,
               dvs.idServicio AS idServicio,
               dvs.idVentaServi AS idVentaServi,
               s.nombreServi AS nombreServi,
               vs.fecha,
               vs.hora,
               vs.numDocum,
               vs.total
              FROM detalleventservicio dvs
              INNER JOIN servicio s ON dvs.idServicio = s.idServicio
              INNER JOIN ventaservicio vs ON dvs.idVentaServi = vs.idVentaServi
              WHERE dvs.idDetalle = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idDetalle]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listdetalleventaservicios()
    {
        return $this->getDetalleVentServicio();
    }

    public function eliminar($idDetalle)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idDetalle=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idDetalle]);
    }

    public function actualizar($idDetalle, $precioUnitario, $idServicio, $idVentaServi)
    {
        $query = "UPDATE detalleventservicio 
              SET precioUnitario = ?, idServicio = ?, idVentaServi = ?
              WHERE idDetalle = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$precioUnitario, $idServicio, $idVentaServi, $idDetalle]);
    }
}