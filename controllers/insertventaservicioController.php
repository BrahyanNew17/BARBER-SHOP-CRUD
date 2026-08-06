<?php

require_once './model/insertventaservicioModel.php';
require_once './config/database.php';


class insertventaservicioController
{
    private $db;
    private $insertventaservicioModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertventaservicioModel = new insertventaservicioModel($this->db);
}

public function insertventaservicio() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $fecha = $_POST["fecha"];
        $hora = $_POST['hora'];
        $numDocum = $_POST['numDocum'];
        $total = $_POST['total'];

        $this->insertventaservicioModel->insertventaservicio($fecha, $hora, $numDocum, $total);
    }
}


     public function listventaservicio()
     {
        
        return $this->insertventaservicioModel->getventaservicio();
     }

     public function searchventaservicio()
{
    $idVentaServi = $_POST['idVentaServi'] ?? '';
    return $this->insertventaservicioModel->getventaserviciobyidventaservi($idVentaServi);
}
     
public function eliminar()
     {
        $idVentaServi= $_POST['idVentaServi'] ?? '';
        $datosUsuario = $this->insertventaservicioModel->eliminar($idVentaServi);
        return $this->insertventaservicioModel->eliminar($idVentaServi);
     }
     
public function actualizarVentaServicio() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idVentaServi'])) {
        $idVentaServi = $_POST['idVentaServi'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $numDocum = $_POST['numDocum'];
        $total = $_POST['total'] ?? '';

        $this->insertventaservicioModel->actualizar($idVentaServi, $fecha, $hora, $numDocum, $total);
        header("Location: index.php?action=openFormUpdateVentaServicio&success=1");
        exit();
    }
}
}
?>