<?php
class insertCategoriaModel
{
private $conn;
private $table='categoria';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertCategoria($categoria)
{
$query="INSERT INTO " . $this->table . "(categoria	
) VALUES(?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$categoria]);
}
public function getcategors()
{
    $query = "SELECT * FROM " . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getcategorByName($categoria)
{
    $query = "SELECT * FROM " . $this->table . " WHERE categoria LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['%' . $categoria . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}  
}
