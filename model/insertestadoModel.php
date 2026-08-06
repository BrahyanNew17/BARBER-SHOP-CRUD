<?php
class insertestadoModel
{
    private $conn;
    private $table = 'estado';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertestado($estado)
    {
        $query = "INSERT INTO " . $this->table . " (estado) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
[$estado]);
    }

    //Metodo para obtener todos los usuarios
public function getEstados()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//metodo para obtener citas por nombre
public function getEstadoByName($estado) {
    $query = "SELECT * FROM " . $this->table . " WHERE estado LIKE :estado";
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':estado', "%$estado%");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminar($estado)
{
    $query = "DELETE FROM " .$this->table. " WHERE estado=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$estado]);

}

public function actualizar($idEstado, $estado)
{
    $query = "UPDATE " . $this->table . " SET estado = ? WHERE idEstado = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$estado, $idEstado]);
}
}