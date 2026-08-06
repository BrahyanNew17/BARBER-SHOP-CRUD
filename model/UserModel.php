<?php
class UserModel
{
    private $conn;
    private $table = 'cliente';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertUser(
        $numDocum,
        $nombreComplet,
        $Telefono,
        $direccion,
        $correo,
        $password,
        $idtipoDoc,
        $idRol
    ) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table . " (numDocum, nombreComplet, Telefono, direccion, correo, password, idtipoDoc, idRol) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $numDocum,
            $nombreComplet,
            $Telefono,
            $direccion,
            $correo,
            $hashedPassword,
            $idtipoDoc,
            $idRol
        ]);
    }

    public function getUsers()
    {
        $query = "SELECT 
                c.numDocum,
                c.nombreComplet,
                c.Telefono,
                c.direccion,
                c.correo,
                c.idtipoDoc,
                t.tipodocumento,
                r.rol,
                c.idRol
              FROM cliente c
              LEFT JOIN tipodocumento t ON c.idtipoDoc = t.idtipoDoc
              INNER JOIN rol r ON c.idRol = r.idRol";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByName($nombreComplet)
    {
        $sql = "SELECT 
                c.numDocum,
                c.nombreComplet,
                c.Telefono,
                c.direccion,
                c.correo,
                t.tipodocumento,
                c.idRol,
                r.rol
            FROM cliente c
            LEFT JOIN tipodocumento t ON c.idtipoDoc = t.idtipoDoc
            INNER JOIN rol r ON c.idRol = r.idRol
            WHERE c.nombreComplet LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["%" . $nombreComplet . "%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByNumDocum($numDocum)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE numDocum = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$numDocum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($numDocum)
    {
        $stmt = $this->conn->prepare("SELECT idVentaProducto FROM ventaproducto WHERE numDocum = ?");
        $stmt->execute([$numDocum]);
        $ventasProducto = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = $this->conn->prepare("SELECT idVentaServi FROM ventaservicio WHERE numDocum = ?");
        $stmt->execute([$numDocum]);
        $ventasServicio = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($ventasProducto)) {
            $placeholders = implode(',', array_fill(0, count($ventasProducto), '?'));
            $stmt = $this->conn->prepare("DELETE FROM devolucion WHERE idVentaProducto IN ($placeholders)");
            $stmt->execute($ventasProducto);

            $stmt = $this->conn->prepare("DELETE FROM detalleventproducto WHERE idVentaProducto IN ($placeholders)");
            $stmt->execute($ventasProducto);
        }

        if (!empty($ventasServicio)) {
            $placeholders = implode(',', array_fill(0, count($ventasServicio), '?'));
            $stmt = $this->conn->prepare("DELETE FROM detalleventservicio WHERE idVentaServi IN ($placeholders)");
            $stmt->execute($ventasServicio);
        }

        $stmt = $this->conn->prepare("DELETE FROM ventaproducto WHERE numDocum = ?");
        $stmt->execute([$numDocum]);

        $stmt = $this->conn->prepare("DELETE FROM ventaservicio WHERE numDocum = ?");
        $stmt->execute([$numDocum]);

        $stmt = $this->conn->prepare("DELETE FROM cita WHERE numDocum = ?");
        $stmt->execute([$numDocum]);

        $stmt = $this->conn->prepare("DELETE FROM cliente WHERE numDocum = ?");
        $stmt->execute([$numDocum]);
    }

    public function actualizar($numDocum, $nombreComplet, $Telefono, $direccion, $correo, $idtipoDoc, $idRol)
    {
        $query = "UPDATE " . $this->table . " SET nombreComplet = ?, Telefono = ?, direccion = ?, correo = ?, idtipoDoc = ?, idRol = ? WHERE numDocum = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nombreComplet, $Telefono, $direccion, $correo, $idtipoDoc, $idRol, $numDocum]);
    }

    public function login($correo, $password)
    {
        $query = "SELECT 
                c.*,
                r.rol
              FROM cliente c
              INNER JOIN rol r ON c.idRol = r.idRol
              WHERE c.correo = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([strtolower(trim($correo))]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        
        if (password_verify($password, $user['password'])) {
            return $user;
        }

        
        if ($password === $user['password']) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE cliente SET password = ? WHERE numDocum = ?");
            $stmt->execute([$hashed, $user['numDocum']]);
            return $user;
        }

        return false;
    }

    public function buscarPorEmail($correo)
    {
        $query = "SELECT * FROM cliente WHERE correo = :correo LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmailConRol($correo)
    {
        $query = "SELECT c.*, r.rol 
                  FROM cliente c
                  INNER JOIN rol r ON c.idRol = r.idRol
                  WHERE c.correo = :correo LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearGoogle($nombre, $correo)
    {
        $tempNumDocum = -time();

        $query = "INSERT INTO cliente 
                  (numDocum, nombreComplet, correo, password, idRol) 
                  VALUES (:numDocum, :nombre, :correo, '', 3)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":numDocum", $tempNumDocum);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }
}
?>