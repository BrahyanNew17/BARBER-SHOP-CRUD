<?php
class insertCategoriaModel
{
    private $conn;
    private $table = 'categoria';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertCategoria($categoria)
    {
        $query = "INSERT INTO " . $this->table . " (categoria) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$categoria]);
    }

    public function getcategors()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategoria($categoria)
    {
        $query = "SELECT * FROM categoria WHERE categoria = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$categoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getcategorByName($categoria)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE categoria LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['%' . $categoria . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($idCategoria)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE idCategoria = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idCategoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar por nombre (legacy)
    public function eliminar($categoria)
    {
        $query = "DELETE FROM " . $this->table . " WHERE categoria = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$categoria]);
    }

    // Eliminar por ID (recomendado)
    public function eliminarPorId($idCategoria)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idCategoria = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idCategoria]);
    }

    public function actualizar($idCategoria, $categoria)
    {
        $query = "UPDATE " . $this->table . " SET categoria = ? WHERE idCategoria = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$categoria, $idCategoria]);
    }
}
?>