<?php

require_once './model/insertProductoModel.php';
require_once './config/database.php';


class insertProductoController
{
    private $db;
    private $insertProductoModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertProductoModel = new insertProductoModel($this->db);
}
public function insertProducto() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nomProducto = $_POST['nomProducto'];
    $precioUni = $_POST['precioUni'];
    $Cantidad = $_POST['Cantidad'];
    $idMarca = $_POST['idMarca'];
    $idCategoria = $_POST['idCategoria'];

    $this->insertProductoModel->insertProducto(
        $nomProducto, 
        $precioUni,
        $Cantidad, 
        $idMarca, 
        $idCategoria
    );
}
}}