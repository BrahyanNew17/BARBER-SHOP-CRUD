<?php

require_once './model/CategoriaModel.php';
require_once './config/database.php';

class CategoriaController {
    private $db;
    private $CategoriaModel;

    public function __construct(){
        $database = new database();
        $this->db = $database->getConnection($this->db);
$this->CategoriaModel = new CategoriaModel($this->db);
    }

    public function listCategoria(){
        return $this->CategoriaModel->getCategoria();
    }
}
?>