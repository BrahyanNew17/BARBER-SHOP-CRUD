<?php

require_once './model/insertestadoModel.php';
require_once './config/database.php';


class insertestadoController
{
    private $db;
    private $insertestadoModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertestadoModel = new insertestadoModel($this->db);
}
public function insertestado() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $estado = $_POST['estado'];
        return $this->insertestadoModel->insertestado($estado);
    }
}
}