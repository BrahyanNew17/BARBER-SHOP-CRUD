<?php

require_once './model/insertServicioModel.php';
require_once './config/database.php';


class insertServicioController
{
    private $db;
    private $insertServicioModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertServicioModel = new insertServicioModel($this->db);
}

public function insertServicio()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreServi = $_POST['nombreServi'];
        $precioUni   = $_POST["precioUni"];
        $duracion    = $_POST["duracion"];

        
        $foto = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], "./photo/" . $foto);
        }

        $this->insertServicioModel->insertServicio($nombreServi, $precioUni, $duracion, $foto);
        header("Location: index.php?action=insertServicio&success=1");
        exit();
    }
}

public function listServicios()
{
    return $this->insertServicioModel->getServicios();
}

public function ServicioByName()
{
    $name = $_POST['nombreServi'] ?? '';
    return $this->insertServicioModel->getServicioByName($name);
}

public function eliminar()
{
    $nombreServi = $_POST['nombreServi'] ?? '';
    $this->insertServicioModel->eliminar($nombreServi);
}

public function openFormUpdateServicio() {
    $servicios = [];
    include "./views/update_servicio.php";
}

public function searchServicioForUpdate() {
    $nombreServi = $_POST['nombreServi'] ?? '';
    $servicios = $this->insertServicioModel->getServicioByName($nombreServi);
    include "./views/update_servicio.php";
}

public function actualizarServicio() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idServicio'])) {
        $idServicio  = $_POST['idServicio'];
        $nombreServi = $_POST['nombreServi'];
        $precioUni   = $_POST['precioUni'];
        $duracion    = $_POST['duracion'];

        // Manejo de foto
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], "./photo/" . $foto);
        }

        $this->insertServicioModel->actualizar($idServicio, $nombreServi, $precioUni, $duracion, $foto);
        header("Location: index.php?action=openFormUpdateServicio&success=1");
        exit();
    }
}
}
?>