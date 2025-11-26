<?php
class insertBarberoModel
{
private $conn;
private $table='barbero';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertBarbero($nomCompleto, $telefono, $correo, $foto)
{
$query="INSERT INTO " . $this->table . "(nomCompleto, telefono,	correo,	foto
) VALUES(?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$nomCompleto, $telefono, $correo, $foto]);
}

public function getBarbers()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getBarberByName($nomCompleto)
{
    $query = "SELECT * FROM " . $this->table . " WHERE nomCompleto LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $nomCompleto . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
}
?>
