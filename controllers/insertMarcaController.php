<?php

require_once './model/insertMarcaModel.php';
require_once './config/database.php';


class insertMarcaController
{
    private $db;
    private $insertMarcaModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertMarcaModel = new insertMarcaModel($this->db);
}
public function insertMarca() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $marca = $_POST['marca'];

        $this->insertMarcaModel->insertMarca($marca);
    }
}

public function listMarca()
     {
        
        return $this->insertMarcaModel->getMarca();
     }

      public function  MarcaBymarca()
     {
        $name = $_GET['name'] ?? '';
        return $this->insertMarcaModel->getMarcaBymarca($name);
     }
}