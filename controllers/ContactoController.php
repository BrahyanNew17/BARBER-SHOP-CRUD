<?php

require_once './config/database.php';

class ContactoController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=contacto");
            exit();
        }

        $nombre   = trim($_POST['nombre']   ?? '');
        $correo   = trim($_POST['correo']   ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $mensaje  = trim($_POST['mensaje']  ?? '');

        if (empty($nombre) || empty($correo) || empty($mensaje)) {
            header("Location: index.php?action=contacto&error=campos_vacios");
            exit();
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            header("Location: index.php?action=contacto&error=correo_invalido");
            exit();
        }

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO contacto (nombre, correo, telefono, mensaje) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$nombre, $correo, $telefono, $mensaje]);
            header("Location: index.php?action=contacto&success=1");
            exit();
        } catch (PDOException $e) {
            error_log("Error contacto: " . $e->getMessage());
            header("Location: index.php?action=contacto&error=sistema");
            exit();
        }
    }

    public function listar()
    {
        require_once './model/ContactoModel.php';
        $contactoModel = new ContactoModel($this->db);
        return $contactoModel->getContactos();
    }

    public function eliminarMensaje()
    {
        require_once './model/ContactoModel.php';
        $contactoModel = new ContactoModel($this->db);
        $idContacto = $_POST['idContacto'] ?? null;
        if ($idContacto) {
            $contactoModel->eliminar($idContacto);
        }
        header("Location: index.php?action=listMensajes");
        exit();
    }
}
