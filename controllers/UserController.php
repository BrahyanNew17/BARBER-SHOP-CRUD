<?php

require_once './model/UserModel.php';
require_once './config/database.php';


class UserController
{
    private $db;
    private $UserModel;


    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->userModel = new userModel($this->db);
}
public function insertUser() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $numDocum = $_POST['numDocum'];
        $nombreComplet = $_POST["nombreComplet"];
        $Telefono = $_POST['Telefono'];
        $direccion = $_POST['direccion'];
        $correo=$_POST['correo'];
       $idtipoDoc=$_POST['idtipoDoc'];
        $this->userModel->insertUser($numDocum, $nombreComplet, $Telefono, $direccion, $correo, $idtipoDoc);
    }
}

public function listUsers()
     {
        return $this->userModel->getUsers();
     }

      public function  UsersByName()
     {
        $name = $_GET['name'] ?? '';
        return $this->userModel->getUserByName($name);
     }

     public function eliminar()
     {
        $numDocum = $_POST['numDocum'] ?? '';
        $datosUsuario = $this->userModel->eliminar($numDocum);
        return $this->userModel->eliminar($numDocum);
     }
}