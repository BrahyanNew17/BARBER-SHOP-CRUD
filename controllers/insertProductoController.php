<?php

require_once './model/insertProductoModel.php';
require_once './config/database.php';


class insertProductoController
{
    private $db;
    private $insertProductoModel;


    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->insertProductoModel = new insertProductoModel($this->db);
    }
    public function insertProducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $nomProducto = $_POST['nomProducto'];
            $descripcion = $_POST['descripcion'];
            $precioUni   = $_POST['precioUni'];
            $foto = '';
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $foto = $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], './photo/' . $foto);
            }
            $Cantidad = $_POST['Cantidad'];
            $idMarca = $_POST['idMarca'];
            $idCategoria = $_POST['idCategoria'];


            $this->insertProductoModel->insertProducto(
                $nomProducto,
                $descripcion,
                $foto,
                $precioUni,
                $Cantidad,
                $idMarca,
                $idCategoria
            );
            header('Location: index.php?action=dashboard&success=producto');
            exit();
        }
    }
    public function listProductos()
    {
        
        return $this->insertProductoModel->getProductos();
    }
    public function consultar()
    {

        $producs = $this->insertProductoModel->getProductos();

        include './views/insertProducto.php';
    }
    public function ProductoByProducto()
    {
        if (isset($_POST['nomProduc'])) {
            $nomProduc = $_POST['nomProduc'];
            return $this->insertProductoModel->getProductoByProducto($nomProduc);
        }
        return [];
    }



    public function eliminar()
    {
        $nomProduc = $_POST['nomProduc'] ?? '';
        $datosUsuario = $this->insertProductoModel->eliminar($nomProduc);
        return $this->insertProductoModel->eliminar($nomProduc);
    }

    public function openFormUpdateProducto()
    {
        $productos = [];
        include "./views/update_producto.php";
    }

    public function searchProductoForUpdate()
    {
        $nomProduc = $_POST['nomProduc'] ?? '';
        $productos = $this->insertProductoModel->getProductoByProducto($nomProduc);
        include "./views/update_producto.php";
    }

    public function actualizarProducto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $nomProduc = $_POST['nomProduc'];
            $descripcion = $_POST['descripcion'];
            $precioUni = $_POST['precioUni'];
            $cantidad = $_POST['cantidad'];
            $idMarca = $_POST['idMarca'] ?? 1;
            $idCategoria = $_POST['idCategoria'] ?? 1;
            $foto = null;

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $foto = $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], "./photo/" . $foto);
            }


            $this->insertProductoModel->actualizarProducto($idProducto, $nomProduc, $descripcion, $precioUni, $cantidad, $idMarca, $idCategoria, $foto);
            header("Location: index.php?action=openFormUpdateProducto&success=1");
            exit();
        }
    }

    public function buscar()
    {
        $texto = $_GET['q'] ?? '';

        if ($texto !== '') {
            $productos = $this->insertProductoModel->buscarProducto($texto);
        } else {
            $productos = $this->insertProductoModel->getProductos();
        }

        include "./views/productobarberia.php";
    }
}