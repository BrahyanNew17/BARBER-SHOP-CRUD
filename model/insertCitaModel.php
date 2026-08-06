<?php
class insertCitaModel
{
    private $conn;
    private $table = 'cita';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertCita($fecha, $hora, $numDocum, $idBarbero, $idEstado, $idServicio)
    {
        $query = "INSERT INTO " . $this->table . " (fecha, hora, numDocum, idBarbero, idEstado, idServicio) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fecha, $hora, $numDocum, $idBarbero, $idEstado, $idServicio]);
    }
    public function existeCliente($numDocum)
    {
        $sql = "SELECT COUNT(*) FROM cliente WHERE numDocum = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$numDocum]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function getCitas()
    {
        $query = "SELECT 
                ci.idCita,
                ci.fecha,
                ci.hora,
                ci.numDocum,
                ci.idBarbero,
                ci.idEstado,
                ci.idServicio,
                b.nomCompleto AS nomCompleto,
                e.estado AS estado,
                s.nombreServi AS nombreServi,
                s.precioUni AS precioServicio
              FROM cita ci
              INNER JOIN barbero b ON ci.idBarbero = b.idBarbero
              INNER JOIN estado e ON ci.idEstado = e.idEstado
              LEFT JOIN servicio s ON ci.idServicio = s.idServicio";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  public function citaOcupada($idBarbero, $fecha, $hora, $idCita = null)
{
    $sql = "SELECT COUNT(*) 
            FROM cita
            WHERE idBarbero = ?
              AND fecha = ?
              AND hora = ?";

    $params = [$idBarbero, $fecha, $hora];

    
    if ($idCita !== null) {
        $sql .= " AND idCita != ?";
        $params[] = $idCita;
    }

    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchColumn() > 0;
}


    
    public function getCitaByNumDocum($numDocum)
    {
        $sql = "SELECT 
                ci.idCita,
                ci.fecha,
                ci.hora,
                ci.numDocum,
                ci.idBarbero,
                ci.idEstado,
                ci.idServicio,
                b.nomCompleto AS nomCompleto,
                e.estado AS estado,
                s.nombreServi AS nombreServi,
                s.precioUni AS precioServicio
            FROM cita ci
              INNER JOIN barbero b ON ci.idBarbero = b.idBarbero
              INNER JOIN estado e ON ci.idEstado = e.idEstado
              LEFT JOIN servicio s ON ci.idServicio = s.idServicio
            WHERE ci.numDocum LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $numDocum . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($idCita)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idCita=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idCita]);
    }

    public function actualizar($idCita, $fecha, $hora, $numDocum, $idBarbero, $idEstado, $idServicio)
    {
        $query = "UPDATE " . $this->table . " SET fecha = ?, hora = ?, numDocum = ?, idBarbero = ?, idEstado = ?, idServicio = ? WHERE idCita = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$fecha, $hora, $numDocum, $idBarbero, $idEstado, $idServicio, $idCita]);
    }
}