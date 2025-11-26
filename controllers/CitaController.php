<?php

require_once './model/CitaModel.php';
require_once './config/database.php';

class CitaController {
    private $db;
    private $CitaModel;

    public function __construct(){
        $database = new database();
        $this->db = $database->getConnection($this->db);
$this->CitaModel = new CitaModel($this->db);
    }

    public function listCita(){
        return $this->CitaModel->getCita();
    }
}
?>