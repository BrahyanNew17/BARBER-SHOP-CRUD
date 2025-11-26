<?php
class UserModel
{
private $conn;
private $table='cliente';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertUser($numDocum, $nombreComplet, $Telefono, 
 $direccion, $correo, $idtipoDoc)
{
$query="INSERT INTO " . $this->table . "(numDocum, nombreComplet,	Telefono,	direccion,	correo, idtipoDoc
) VALUES(?, ?, ?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$numDocum, $nombreComplet, $Telefono, 
 $direccion, $correo, $idtipoDoc]);
}

//Metodo para obtener todos los usuarios
public function getUsers()
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