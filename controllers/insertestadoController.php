<?php

require_once './model/insertestadoModel.php';
require_once './config/database.php';


class insertestadoController
{
    private $db;
    private $insertestadoModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertestadoModel = new insertestadoModel($this->db);
}
public function insertestado() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $estado = $_POST['estado'];
        return $this->insertestadoModel->insertestado($estado);
    }
}

public function listEstados()
     {
        return $this->insertestadoModel->getEstados();
     }

      public function estadoByName()
     {
        $estado = $_POST['estado'] ?? '';
        return $this->insertestadoModel->getEstadoByName($estado);
     }

     public function eliminar()
     {
        $estado = $_POST['estado'] ?? '';
        $datosUsuario = $this->insertestadoModel->eliminar($estado);
        return $this->insertestadoModel->eliminar($estado);
     }

public function openFormUpdateEstado() {
    $estados = [];
    include "./views/update_estado.php";
}

public function searchEstadoForUpdate() {
    $estado = $_POST['estado'] ?? '';
    $estados = $this->insertestadoModel->getEstadoByName($estado);
    include "./views/update_estado.php";
}

public function actualizarEstado() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idEstado'])) {
        $idEstado = $_POST['idEstado'];
        $estado = $_POST['estado'];

        $this->insertestadoModel->actualizar($idEstado, $estado);
        header("Location: index.php?action=openFormUpdateEstado&success=1");
        exit();
    }
}
}