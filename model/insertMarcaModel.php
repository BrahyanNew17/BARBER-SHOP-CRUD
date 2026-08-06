<?php
class insertMarcaModel
{
private $conn;
private $table='marca';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertMarca($marca)
{
$query="INSERT INTO " . $this->table . " (marca
) VALUES(?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$marca]);
}

    //Metodo para obtener todos las marcas
public function getMarca()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getMarcaBymarca($marca)
{
    $query = "SELECT * FROM " . $this->table . " WHERE marca LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $marca . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function eliminar($marca)
{
    $query = "DELETE FROM " .$this->table. " WHERE marca=?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$marca]);

}

public function actualizar($idMarca, $marca)
{
    $query = "UPDATE " . $this->table . " SET marca = ? WHERE idMarca = ?";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$marca, $idMarca]);
}
}
?>