<?php
require_once './model/insertCategoriaModel.php';
require_once './config/database.php';
class insertCategoriaController
{
    private $db;
    private $insertCategoriaModel;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertCategoriaModel = new insertCategoriaModel($this->db);
    }
    public function insertCategoria() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $categoria = $_POST['categoria'];
            $this->insertCategoriaModel->insertCategoria($categoria);
        }
    }
    public function listcategors()
    {
        return $this->insertCategoriaModel->getcategors();
    }
    public function categorByName()
    {
        $categoria = $_POST['categoria'] ?? '';
        return $this->insertCategoriaModel->getcategorByName($categoria);
    }
    public function buscarPorCategoria()
    {
        if (isset($_POST['categoria'])) {
            return $this->insertCategoriaModel->getByCategoria($_POST['categoria']);
        }
        return null;
    }
    public function eliminar()
    {
        $categoria = $_POST['categoria'] ?? '';
        if (!empty($categoria)) {
            $this->insertCategoriaModel->eliminar($categoria);
        }
    }
    public function actualizar() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCategoria'])) {
            $idCategoria = $_POST['idCategoria'];
            $categoria = $_POST['categoria'];
            $this->insertCategoriaModel->actualizar($idCategoria, $categoria);
            header("Location: index.php?action=openFormUpdateCategoria&success=1");
            exit();
        }
    }
    public function openFormUpdateCategoria() 
    {
        $categorias = [];
        include "./views/update_categoria.php";
    }
    public function searchCategoriaForUpdate() 
    {
        $categoria = $_POST['categoria'] ?? '';
        $categorias = $this->insertCategoriaModel->getcategorByName($categoria);
        include "./views/update_categoria.php";
    }
    public function actualizarCategoria() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCategoria'])) {
            $idCategoria = $_POST['idCategoria'];
            $categoria = $_POST['categoria'];
            $this->insertCategoriaModel->actualizar($idCategoria, $categoria);
            header("Location: index.php?action=openFormUpdateCategoria&success=1");
            exit();
        }
    }
}
?>