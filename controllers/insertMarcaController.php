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
        $name = $_POST['marca'] ?? '';
        return $this->insertMarcaModel->getMarcaBymarca($name);
     }

       public function eliminar()
     {
        $marca = $_POST['marca'] ?? '';
        $datosUsuario = $this->insertMarcaModel->eliminar($marca);
        return $this->insertMarcaModel->eliminar($marca);
     }

public function openFormUpdateMarca() {
    $marcas = [];
    include "./views/update_marca.php";
}

public function searchMarcaForUpdate() {
    $marca = $_POST['marca'] ?? '';
    $marcas = $this->insertMarcaModel->getMarcaBymarca($marca);
    include "./views/update_marca.php";
}

public function actualizarMarca() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idMarca'])) {
        $idMarca = $_POST['idMarca'];
        $marca = $_POST['marca'];

        $this->insertMarcaModel->actualizar($idMarca, $marca);
        header("Location: index.php?action=openFormUpdateMarca&success=1");
        exit();
    }
}
}