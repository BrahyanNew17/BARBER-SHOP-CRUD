<?php

require_once './model/insertProveedorModel.php';
require_once './config/database.php';


class insertProveedorController
{
    private $db;
    private $insertProveedorModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertProveedorModel = new insertProveedorModel($this->db);
}
public function insertProveedor() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $NITproveedor = $_POST['NITproveedor'];
        $nombreProveedor = $_POST["nombreProveedor"];
        $direcProveedor = $_POST["direcProveedor"];
        $telefono = $_POST['telefono'];

        $this->insertProveedorModel->insertProveedor($NITproveedor, $nombreProveedor, $direcProveedor, $telefono);
    }
}

public function listProveedores()
     {
        return $this->insertProveedorModel->getProveedores();
     }

      public function  ProveedorByName()
     {
        $name = $_POST['nombreProveedor'] ?? '';
        return $this->insertProveedorModel->getProveedorByName($name);
     }

       public function eliminar()
     {
        $nombreProveedor = $_POST['nombreProveedor'] ?? '';
        $datosUsuario = $this->insertProveedorModel->eliminar($nombreProveedor);
        return $this->insertProveedorModel->eliminar($nombreProveedor);
     }

public function openFormUpdateProveedor() {
    $proveedores = [];
    include "./views/update_proveedor.php";
}

public function searchProveedorForUpdate() {
    $nombreProveedor = $_POST['nombreProveedor'] ?? '';
    $proveedores = $this->insertProveedorModel->getProveedorByName($nombreProveedor);
    include "./views/update_proveedor.php";
}

public function actualizarProveedor() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['NITproveedor'])) {
        $NITproveedor = $_POST['NITproveedor'];
        $nombreProveedor = $_POST['nombreProveedor'];
        $direcProveedor = $_POST['direcProveedor'];
        $telefono = $_POST['telefono'];

        $this->insertProveedorModel->actualizar($NITproveedor, $nombreProveedor, $direcProveedor, $telefono);
        header("Location: index.php?action=openFormUpdateProveedor&success=1");
        exit();
    }
}

}
