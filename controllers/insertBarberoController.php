<?php

require_once './model/insertBarberoModel.php';
require_once './config/database.php';


class   insertBarberoController
{
    private $db;
    private $insertBarberoModel;

    public function __construct()
{
    $database = new Database();
    $this->db = $database->getConnection();
    $this->insertBarberoModel = new insertBarberoModel($this->db);
}
public function insertBarbero() 
{
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nomCompleto = $_POST['nomCompleto'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        

        $foto=$_FILES['foto']['name'];
        $target_dir="photo/";
        $target_file=$target_dir . basename($foto);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

        $this->insertBarberoModel->insertBarbero($nomCompleto, $telefono, $correo, $foto);
    }
}

public function listBarbers()
     {
        return $this->insertBarberoModel->getBarbers();
     }

      public function  BarberByName()
     {
        $name = $_GET['name'] ?? '';
        return $this->insertBarberoModel->getBarberByName($name);
     }
}