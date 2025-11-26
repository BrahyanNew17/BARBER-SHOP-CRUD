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
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombreServi= $_POST['nombreServi'];
        $precioUni = $_POST["precioUni"];
        $duracion = $_POST["duracion"];

        $this->insertServicioModel->insertServicio($nombreServi, $precioUni, $duracion);
    }
}
}