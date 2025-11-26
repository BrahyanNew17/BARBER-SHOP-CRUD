<?php
class insertProductoModel
{
private $conn;
private $table='producto';

public function __construct($db)
{
    $this->conn=$db;
}

public function insertProducto($nomProduc, $precioUni, $cantidad, $idMarca, $idCategoria)
{
$query="INSERT INTO " . $this->table . "(nomProduc, precioUni, cantidad, idMarca, idCategoria
) VALUES(?, ?, ?, ?, ?)";
 $stmt= $this->conn->prepare($query);
 $stmt->execute([$nomProduc, $precioUni, $cantidad, $idMarca, $idCategoria]);
}
}