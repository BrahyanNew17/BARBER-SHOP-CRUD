<?php
class insertCitaModel
{
private $conn;
private $table='cita';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertCita($fecha, $hora, $numDocum, $idBarbero, $idEstado)
{
$query="INSERT INTO " . $this->table . "(fecha, hora,	numDocum,	idBarbero,	idEstado
) VALUES(?, ?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$fecha, $hora, $numDocum, $idBarbero, $idEstado]);
}

//Metodo para obtener todos los usuarios
public function getCitas()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//metodo para obtener usuarios por nombre
public function getUserByName($name) {
    $query = "SELECT * FROM cliente WHERE nombreComplet LIKE :name";
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':name', "%$name%");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminar($numDocum)
{
    $query = "DELETE FROM " .$this->table. " WHERE numDocum=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$numDocum]);

} 
}
?>