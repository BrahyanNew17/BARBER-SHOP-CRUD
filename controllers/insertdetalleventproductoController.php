<?php

require_once './model/insertdetalleventproductoModel.php';
require_once './config/database.php';


class insertdetalleventproductoController
{
    private $db;
    private $insertdetalleventproductoModel;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertdetalleventproductoModel = new insertdetalleventproductoModel($this->db);
    }
    
    public function insertdetalleventproducto()
    {
        $subTotal = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cantidad = $_POST["cantidad"] ?? 0;
            $precioUnitario = $_POST['precioUnitario'] ?? 0;
            $idProducto = $_POST['idProducto'] ?? '';
            $idVentaProducto = $_POST['idVentaProducto'] ?? '';
            
            $subTotal = $cantidad * $precioUnitario;

            if (!empty($idVentaProducto) && !empty($idProducto)) {
                $this->insertdetalleventproductoModel->insertdetalleventproducto(
                    $cantidad,
                    $precioUnitario,
                    $subTotal,
                    $idProducto,
                    $idVentaProducto
                );
                header("Location: index.php?action=listdetalleventaproductos");
                exit();
            } else {
                echo "Error: Faltan datos obligatorios (Producto o Venta).";
            }
        }
        return $subTotal;
    }

    public function listdetalleventaproductos()
    {
        return $this->insertdetalleventproductoModel->getDetalleVentProducto();
    }

    public function searchDetalleVentaProducto()
    {
        $idVentaProducto = $_POST['idVentaProducto'] ?? '';
        return $this->insertdetalleventproductoModel->getDetalleVentProductoById($idVentaProducto);
    }

    public function eliminar()
    {
        $idDetalleVent = $_POST['idDetalleVent'] ?? '';
        return $this->insertdetalleventproductoModel->eliminar($idDetalleVent);
    }

    public function actualizarDetalleVentProducto() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDetalleVent'])) {
            $idDetalleVent = $_POST['idDetalleVent'];
            $cantidad = $_POST['cantidad'];
            $precioUnitario = $_POST['precioUnitario'];
            $idProducto = $_POST['idProducto'];
            $idVentaProducto = $_POST['idVentaProducto'];
            
            $subTotal = $cantidad * $precioUnitario;
            
            $this->insertdetalleventproductoModel->actualizar(
                $idDetalleVent, 
                $cantidad, 
                $precioUnitario,
                $subTotal,
                $idProducto, 
                $idVentaProducto
            );
            
            header("Location: index.php?action=openFormUpdateDetalleVentProducto&success=1");
            exit();
        }
    }
}