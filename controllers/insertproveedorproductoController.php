<?php

require_once './model/insertproveedorproductoModel.php';
require_once './config/database.php';


class insertproveedorproductoController
{
    private $db;
    private $insertproveedorproductoModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertproveedorproductoModel = new insertproveedorproductoModel($this->db);
}
public function insertproveedorproducto() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $NITproveedor = $_POST["NITproveedor"] ?? '';
        $idProducto   = $_POST['idProducto'] ?? '';

        $this->insertproveedorproductoModel->insertproveedorproducto($NITproveedor, $idProducto);
    }
}
public function listproveedorproducto()
     {
        return $this->insertproveedorproductoModel->getproveedorproductos();
     }

     public function searchproveedorproducto()
{
    $idProveProduc = $_POST['idProveProduc'] ?? '';
    return $this->insertproveedorproductoModel->getproveedorproductobyidproveproduc($idProveProduc);
}
     public function eliminar()
     {
        $idProveProduc= $_POST['idProveProduc'] ?? '';
        $this->insertproveedorproductoModel->eliminar($idProveProduc);
     }
}