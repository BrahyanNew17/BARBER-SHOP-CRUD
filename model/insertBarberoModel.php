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
$query="INSERT INTO " . $this->table . " (nomCompleto, telefono,	correo,	foto
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
public function getByNombre($nomCompleto)
{
    $query = "SELECT * FROM barbero WHERE nomCompleto = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nomCompleto]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function getBarberByName($nomCompleto)
{
    $query = "SELECT * FROM " . $this->table . " WHERE nomCompleto LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $nomCompleto . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);


}

public function eliminar($nomCompleto)
{
    $stmt = $this->conn->prepare("SELECT idBarbero FROM barbero WHERE nomCompleto = ?");
    $stmt->execute([$nomCompleto]);
    $barb = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($barb) {
        $idBarbero = $barb['idBarbero'];

        $this->conn->prepare("DELETE FROM cita WHERE idBarbero = ?")->execute([$idBarbero]);
    }

    $query = "DELETE FROM " . $this->table . " WHERE nomCompleto=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$nomCompleto]);
}

public function actualizar($idBarbero, $nomCompleto, $telefono, $correo, $foto) {
    $query = "UPDATE barbero 
              SET nomCompleto = ?, telefono = ?, correo = ?, foto = ?
              WHERE idBarbero = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$nomCompleto, $telefono, $correo, $foto, $idBarbero]);
}

}
?>