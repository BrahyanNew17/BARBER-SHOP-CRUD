<?php

require_once './model/insertventaproductoModel.php';
require_once './config/database.php';


class insertventaproductoController
{
    private $db;
    private $insertventaproductoModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertventaproductoModel = new insertventaproductoModel($this->db);
    }

    public function insertventaproducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha    = $_POST["fecha"];
            $hora     = $_POST['hora'];
            $total    = $_POST['total'];
            $numDocum = $_POST['numDocum'];

            $this->insertventaproductoModel->insertventaproducto($fecha, $hora, $total, $numDocum);
        }
    }

    // ★ CORREGIDO: ahora retorna los datos en lugar de incluir la vista
    public function listventaproducto()
    {
        return $this->insertventaproductoModel->getventaproductos();
    }

    // ★ CORREGIDO: ahora retorna los datos en lugar de incluir la vista
    public function searchventaproducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['idVentaProducto'])) {
            $idVentaProducto = $_POST['idVentaProducto'];
            return $this->insertventaproductoModel->getventaproductobyidventaproducto($idVentaProducto);
        }

        // Sin búsqueda → devuelve todos
        return $this->insertventaproductoModel->getventaproductos();
    }

    public function getVentasProductos()
    {
        return $this->insertventaproductoModel->getventaproductos();
    }

   public function openFormDeleteVentaProducto()
{
    return $this->insertventaproductoModel->getventaproductos();
}

    public function eliminar()
    {
        $idVentaProducto = $_POST['idVentaProducto'] ?? '';
        return $this->insertventaproductoModel->eliminar($idVentaProducto);
    }

    public function actualizarVentaProducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idVentaProducto'])) {
            $idVentaProducto = $_POST['idVentaProducto'];
            $fecha           = $_POST['fecha'];
            $hora            = $_POST['hora'];
            $total           = $_POST['total'] ?? '';
            $numDocum        = $_POST['numDocum'];

            $this->insertventaproductoModel->actualizar($idVentaProducto, $fecha, $hora, $total, $numDocum);
            header("Location: index.php?action=openFormUpdateVentaProducto&success=1");
            exit();
        }
    }
}