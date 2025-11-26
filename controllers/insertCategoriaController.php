<?php

require_once './model/insertCategoriaModel.php';
require_once './config/database.php';


class insertCategoriaController
{
    private $db;
    private $insertCategoriaModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertCategoriaModel = new insertCategoriaModel($this->db);
}
public function insertCategoria() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $categoria = $_POST['categoria'];
        
        $this->insertCategoriaModel->insertCategoria($categoria);
    }
}

public function listcategors()
     {
        return $this->insertCategoriaModel->getcategors();
     }

      public function  categorByName()
     {
        $name = $_POST['name'] ?? '';
        return $this->insertCategoriaModel->getcategorByName($name);
     }
}