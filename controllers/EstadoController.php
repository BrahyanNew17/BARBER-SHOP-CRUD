<?php

require_once './model/EstadoModel.php';
require_once './config/database.php';

class EstadoController {
    private $db;
    private $CitaModel;
    private $EstadoModel;

    public function __construct(){
        $database = new database();
        $this->db = $database->getConnection($this->db);
$this->EstadoModel = new EstadoModel($this->db);
    }

    public function listEstado(){
        return $this->EstadoModel->getEstado();
    }
    

}
?>