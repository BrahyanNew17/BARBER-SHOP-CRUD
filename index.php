<?php
require_once './controllers/UserController.php';
require_once './controllers/TipDocumController.php';
require_once './controllers/CategoriaController.php';
require_once './controllers/CitaController.php';
require_once './controllers/EstadoController.php';
require_once './controllers/insertTipDocumController.php';
require_once './controllers/insertBarberoController.php';
require_once './controllers/insertCategoriaController.php';
require_once './controllers/insertMarcaController.php';
require_once './controllers/insertProveedorController.php';
require_once './controllers/insertServicioController.php';
require_once './controllers/insertestadoController.php';
require_once './controllers/insertProductoController.php';
require_once './controllers/insertCitaController.php';

$userController = new UserController();
$TipDocumController = new TipDocumController();
$CategoriaController = new CategoriaController();
$CitaController = new CitaController();
$EstadoController = new EstadoController();
$insertTipDocumController = new insertTipDocumController();
$insertBarberoController = new insertBarberoController();
$insertCategoriaController = new insertCategoriaController();
$insertMarcaController = new insertMarcaController();
$insertProveedorController = new insertProveedorController();
$insertServicioController = new insertServicioController();
$insertestadoController = new insertestadoController();
$insertProductoController = new insertProductoController();
$insertCitaController = new insertCitaController();

$action = $_GET['action'] ?? 'dashboard';
// echo $action; // muestra la accion actual

switch ($action){
    case 'insertUser':
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $users = $userController->insertUser();
            include './views/dashboard.php';
        }else {
            $docums = $TipDocumController->listTipDocum();
            $categors = $CategoriaController->listCategoria();
            $citas = $CitaController->listCita();
            $estados = $EstadoController->listEstado();
            include './views/insert_User.php';
        }
        break;
        case 'insertTipDocum':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertTipDocumController->insertTipDocum();
            header("Location: index.php?action=dashboard");
        exit;
        }else {
            $docums = $TipDocumController->listTipDocum();
            include './views/insertTipDocum.php';
        }
        break;

        case 'insertBarbero':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertBarberoController->insertBarbero();
            header("Location: index.php?action=dashboard");
        exit;
        }else {
         
            include './views/insertBarbero.php';
        }
        break;

        case 'insertCategoria':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertCategoriaController->insertCategoria();
            header("Location: index.php?action=dashboard");
        exit;
        }else {
            $CategoriaController->listCategoria();
            include './views/insertCategoria.php';
        }
        break;
        case 'insertMarca':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertMarcaController->insertMarca();
            header("Location: index.php?action=dashboard");
        exit;
        }else {
          
            include './views/insertMarca.php';
        }
        break;
         case 'insertProveedor':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertProveedorController->insertProveedor();
            header("Location: index.php?action=dashboard");
        exit;
        }else {

            include './views/insertProveedor.php';
        }
        break;

        case 'insertServicio':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertServicioController->insertServicio();
            header("Location: index.php?action=dashboard");
        exit;
        }else {

            include './views/insertServicio.php';
        }
        break;

        case 'insertServicio':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertServicioController->insertServicio();
            header("Location: index.php?action=dashboard");
        exit;
        }else {

            include './views/insertServicio.php';
        }
        break;

        case 'insertestado':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertestadoController->insertestado();
            header("Location: index.php?action=dashboard");
        exit;
        }else {

            include './views/insertestado.php';
        }
        break;

         case 'insertProducto':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $insertProductoController->insertProducto();
            header("Location: index.php?action=dashboard");
        exit;
        }else {

            include './views/insertProducto.php';
        }
        break;

         case 'insertCita':
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $cits = $insertCitaController->insertCita();
            include './views/dashboard.php';
        }else {

            include './views/insertCita.php';
        }
        break;
  case'openFormDelete':
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
           $users=$userController->eliminar();

            include './views/dashboard.php';
        
        }else {
           $users=$userController->listUsers();

            include './views/delete_user_By_Num_Docum.php';
        }
        break;
        case 'dashboard':
            include './views/dashboard.php';
            break;

            case "listUsers":
                  $users = $userController->listusers();
                  include "./views/list_users.php";
                   break;
           case "searchUserByName":
                  $users = $userController->UsersByName();
                  include "./views/list_user_By_name_Form.php";
                   break;
              case "listbarbers":
                  $barbers = $insertBarberoController->listbarbers();
                  include "./views/list_barberos.php";
                   break;
                

                   case "searchBarberByName":
                  $barbers = $insertBarberoController->BarberByName();
                  include "./views/list_barber_By_name_Form.php";
                   break;

                   case "listTipDocum":
                  $tips = $insertTipDocumController->listTipDocum();
                  include "./views/list_TipDocum.php";
                   break;

                    case "listMarca":
                  $marcs = $insertMarcaController->listMarca();
                  include "./views/list_marcas.php";
                   break;

                   case "searchMarcaBymarca":
                  $marcs = $insertMarcaController->MarcaBymarca();
                  include "./views/list_marca_By_marca_Form.php";
                   break;

                     case "listProveedores":
                  $proveedors = $insertProveedorController->listProveedores();
                  include "./views/list_proveedor.php";
                   break;

                   case "searchProveedorByName":
                  $proveedors = $insertProveedorController->ProveedorByName();
                  include "./views/list_proveedor_By_name_Form.php";
                   break;

                   case "listcategors":
                  $categors = $insertCategoriaController->listcategors();
                  include "./views/list_categorias.php";
                   break;

                   case "searchcategorByName":
                  $categors= $insertCategoriaController->categorByName();
                  include "./views/list_categoria_By_categoria_Form.php";
                   break;
}
?>