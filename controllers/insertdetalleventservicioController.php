<?php

require_once './model/insertdetalleventservicioModel.php';
require_once './config/database.php';


class insertdetalleventservicioController
{
    private $db;
    private $insertdetalleventservicioModel;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertdetalleventservicioModel = new insertdetalleventservicioModel($this->db);
    }
    public function insertdetalleventservicio()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $precioUnitario = $_POST['precioUnitario'];
            $idServicio     = $_POST['idServicio'];

            $idVentaServi = $_POST['idVentaServi'];
            $this->insertdetalleventservicioModel->insertdetalleventservicio($precioUnitario, $idServicio, $idVentaServi);
        }
    }


    public function listdetalleventaservicios()
    {
        return $this->insertdetalleventservicioModel->getDetalleVentServicio();
    }

    public function searchDetalleVentaServicio()
    {
        $idVentaServi = $_POST['idVentaServi'] ?? '';
        return $this->insertdetalleventservicioModel->getDetalleVentServicioById($idVentaServi);
    }


    public function searchDetalleVentaServicioByIdDetalle()
    {
        $idDetalle = $_POST['idDetalle'] ?? '';
        return $this->insertdetalleventservicioModel->getDetalleVentServicioByIdDetalle($idDetalle);
    }
    public function eliminar()
    {
        $idDetalle = $_POST['idDetalle'] ?? '';
        $this->insertdetalleventservicioModel->eliminar($idDetalle);
    }

    public function actualizarDetalleVentServicio() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDetalle'])) {
        $idDetalle = $_POST['idDetalle'];
        $precioUnitario = $_POST['precioUnitario'];
        $idServicio = $_POST['idServicio'];
        $idVentaServi = $_POST['idVentaServi'];
        

        $this->insertdetalleventservicioModel->actualizar($idDetalle, $precioUnitario, $idServicio, $idVentaServi);
        header("Location: index.php?action=openFormUpdateDetalleVentServicio&success=1");
        exit();
    }
}
}