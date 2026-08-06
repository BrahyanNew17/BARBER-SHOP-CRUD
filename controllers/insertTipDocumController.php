<?php

require_once './model/insertTipDocumModel.php';
require_once './config/database.php';

class insertTipDocumController
{
    private $db;
    private $insertTipDocumModel;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->getConnection();
        $this->insertTipDocumModel = new insertTipDocumModel($this->db);
    }

    public function listinsertTipDocum()
    {
        return $this->insertTipDocumModel->getinsertTipDocum();
    }
    public function insertTipDocum()
    {
        if (isset($_POST["tipo_documento"])) {
            $tipo = $_POST["tipo_documento"];
            return $this->insertTipDocumModel->insertTipDocum($tipo);
        } else {
            echo "No se recibió el dato 'tipo_documento'";
            return false;
        }
    }

    public function getTipDocum()
    {

        return $this->insertTipDocumModel->getTipDocum();
    }

    public function listTipDocum()
    {
        return $this->insertTipDocumModel->getTipDocum();
    }

public function buscarPorTipo()
{
    if (isset($_POST['tipoDocumento'])) {
        return $this->insertTipDocumModel->getByTipo($_POST['tipoDocumento']);
    }
    return null;
}


    public function eliminar()
    {
        if (isset($_POST['tipoDocumento'])) {
            $tipoDocumento = $_POST['tipoDocumento'];
            $this->insertTipDocumModel->eliminar($tipoDocumento);
        }
    }



    public function actualizar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idtipoDoc'])) {
        $idtipoDoc = $_POST['idtipoDoc'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $this->insertTipDocumModel->actualizar($idtipoDoc, $tipoDocumento);
        
        header("Location: index.php?action=openFormUpdateTipDocum");
        exit();
    }

    $editarDatos = null;
    if (isset($_GET['idtipoDoc'])) {
        $editarDatos = $this->insertTipDocumModel->getById($_GET['idtipoDoc']);
    }

    $tips = $this->insertTipDocumModel->getTipDocum();
    require_once './views/update_tipdocum.php';
}
}
