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
        $name = $_GET['name'] ?? '';
        return $this->insertProveedorModel->getProveedorByName($name);
     }
}

?>
