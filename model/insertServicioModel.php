<?php
class insertServicioModel
{
    private $conn;
    private $table='servicio';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertServicio($nombreServi, $precioUni, $duracion, $foto)
{
    $query = "INSERT INTO " . $this->table . " (nombreServi, precioUni, duracion, foto) VALUES(?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nombreServi, $precioUni, $duracion, $foto]);
}

public function getServicios()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getServicioByName($nombreServi)
{
    $query = "SELECT * FROM " . $this->table . " WHERE nombreServi LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $nombreServi . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminar($nombreServi)
{
    $stmt = $this->conn->prepare("SELECT idServicio FROM servicio WHERE nombreServi = ?");
    $stmt->execute([$nombreServi]);
    $serv = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($serv) {
        $idServicio = $serv['idServicio'];

        $this->conn->prepare("DELETE FROM detalleventservicio WHERE idServicio = ?")->execute([$idServicio]);
        $this->conn->prepare("UPDATE cita SET idServicio = NULL WHERE idServicio = ?")->execute([$idServicio]);
    }

    $query = "DELETE FROM " . $this->table . " WHERE nombreServi=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nombreServi]);
}

public function actualizar($idServicio, $nombreServi, $precioUni, $duracion, $foto = null)
{
    if ($foto) {
        $query = "UPDATE " . $this->table . " SET nombreServi = ?, precioUni = ?, duracion = ?, foto = ? WHERE idServicio = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nombreServi, $precioUni, $duracion, $foto, $idServicio]);
    } else {
        $query = "UPDATE " . $this->table . " SET nombreServi = ?, precioUni = ?, duracion = ? WHERE idServicio = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nombreServi, $precioUni, $duracion, $idServicio]);
    }
}
}
?>