<?php

require_once './model/insertCitaModel.php';
require_once './config/database.php';


class insertCitaController
{
    private $db;
    private $insertCitaModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertCitaModel = new insertCitaModel($this->db);
}
public function insertCita() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $fecha = $_POST['fecha'];
        $hora = $_POST["hora"];
        $numDocum = $_POST['numDocum'];
        $idBarbero = $_POST['idBarbero'];
        $idEstado=$_POST['idEstado'];

        $this->insertCitaModel->insertCita($fecha, $hora, $numDocum, $idBarbero, $idEstado);
    }
}

public function listCitas()
     {
        return $this->insertCitaModel->getCitas();
     }

      public function  UsersByName()
     {
        $name = $_GET['name'] ?? '';
        return $this->userModel->getUserByName($name);
     }

     public function eliminar()
     {
        $idCita = $_POST['idCita'] ?? '';
        $datosUsuario = $this->insertCitaModel->eliminar($idCita);
        return $this->insertCitaModel->eliminar($idCita);
     }
}