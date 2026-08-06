<?php
class ContactoModel
{
    private $conn;
    private $table = 'contacto';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getContactos()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($idContacto)
    {
        $query = "DELETE FROM " . $this->table . " WHERE idContacto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idContacto]);
    }
}
