<?php

require_once './model/insertTipDocumModel.php';
require_once './config/database.php';

class insertTipDocumController {
    private $db;
    private $insertTipDocumModel;

    public function __construct(){
        $database = new database();
        $this->db = $database->getConnection($this->db);
$this->insertTipDocumModel = new insertTipDocumModel($this->db);
    }

    public function listinsertTipDocum(){
        return $this->insertTipDocumModel->getinsertTipDocum();
    }
    public function insertTipDocum(){
    if (isset($_POST["tipo_documento"])) {
        $tipo = $_POST["tipo_documento"];
        return $this->insertTipDocumModel->insertTipDocum($tipo);
    } else {
        echo "No se recibió el dato 'tipo_documento'";
        return false;
    }
}

public function listTipDocum()
     {
        return $this->insertTipDocumModel->getTipDocum();
     }
}
?>