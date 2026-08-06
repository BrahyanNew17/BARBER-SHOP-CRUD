<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './controllers/UserController.php';
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
require_once './controllers/insertdetalleventproductoController.php';
require_once './controllers/insertdetalleventservicioController.php';
require_once './controllers/insertproveedorproductoController.php';
require_once './controllers/insertventaproductoController.php';
require_once './controllers/insertventaservicioController.php';
require_once './controllers/Registercontroller.php';
require_once './controllers/ContactoController.php';
require_once './config/database.php';

$database = new Database();
$db = $database->getConnection();

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$userController = new userController();
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
$insertdetalleventproductoController = new insertdetalleventproductoController();
$insertproveedorproductoController = new insertproveedorproductoController();
$insertventaproductoController = new insertventaproductoController();
$insertventaservicioController = new insertventaservicioController();
$insertdetalleventservicioController = new insertdetalleventservicioController();
$registerController = new RegisterController();
$contactoController = new ContactoController();

$action = $_POST['action'] ?? $_GET['action'] ?? 'principal';

if ($action === 'login') {
    $userController->login();
}

$acciones_publicas = [
    'login', 'login1', 'register', 'registerUser',
    'recuperar_password', 'sendResetEmail', 'sendMailView', 'resetPassword', 'updatePassword',
    'principal', 'serviciobarberia', 'productobarberia', 'sobre_nosotros', 'contacto',
    'categoria',
    'maquinasyherramientas', 'tijerasyherramientas', 'cuidadocapilar', 'cuidadodebarbayafeitado',
    'accesoriosdebarberia', 'productosdesinfectantes', 'cuidadofacial', 'herramientasprofesionales',
    'listbarbers', 'searchBarberByName', 'listTipDocum', 'listMarca', 'searchMarcaBymarca',
    'listProveedores', 'searchProveedorByName', 'listcategors', 'searchcategorByName',
    'listServicios', 'searchServicioByName', 'listEstados', 'listProductos', 'searchProductoByProducto',
    'listCitas', 'searchCitaByNumDocum',
    'listdetalleventaproducto', 'searchDetalleVentaProducto',
    'listdetalleventservicio', 'searchDetalleVentaServicio',
    'listproveedorproducto', 'searchproveedorproducto',
    'listventaproducto', 'searchventaproducto',
    'listventaservicio', 'searchventaservicio', 'openFormDelete',
    'checkout', 'procesarVenta', 'factura', 'googleLogin', 'misPedidos',
    'solicitarDevolucion', 'procesarDevolucion', 'descargarFactura',
    'completarPerfil', 'guardarPerfil', 'googleCallback', 'enviarContacto'
];

if (!in_array($action, $acciones_publicas) && !isset($_SESSION['rol'])) {
    include "./views/barbershop.php";
    exit();
}

switch ($action) {


    case 'principal':
        include './views/barbershop.php';
        break;

    case "serviciobarberia":
        include './views/serviciobarberia.php';
        break;

    case "productobarberia":
        include './views/productobarberia.php';
        break;

    case "sobre_nosotros":
        include './views/sobre_nosotros.php';
        break;

    case "contacto":
        include './views/contacto.php';
        break;

    case 'enviarContacto':
        $contactoController->guardar();
        break;

    case "categoria":
        $idCat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($idCat <= 0) {
            header("Location: index.php?action=productobarberia");
            exit();
        }
        $_GET['categoria'] = $idCat;
        include './views/categoria_productos.php';
        break;

    // Casos legacy mantenidos por compatibilidad con enlaces existentes
    case "maquinasyherramientas":
        $_GET['categoria'] = 1;
        include './views/categoria_productos.php';
        break;

    case "tijerasyherramientas":
        $_GET['categoria'] = 2;
        include './views/categoria_productos.php';
        break;

    case "cuidadocapilar":
        $_GET['categoria'] = 3;
        include './views/categoria_productos.php';
        break;

    case "cuidadodebarbayafeitado":
        $_GET['categoria'] = 4;
        include './views/categoria_productos.php';
        break;

    case "accesoriosdebarberia":
        $_GET['categoria'] = 5;
        include './views/categoria_productos.php';
        break;

    case "productosdesinfectantes":
        $_GET['categoria'] = 6;
        include './views/categoria_productos.php';
        break;

    case "cuidadofacial":
        $_GET['categoria'] = 7;
        include './views/categoria_productos.php';
        break;

    case "herramientasprofesionales":
        $_GET['categoria'] = 8;
        include './views/categoria_productos.php';
        break;


    case 'insertUser':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $users = $userController->insertUser();
            include './views/dashboard.php';
        } else {
            $docums   = $insertTipDocumController->listTipDocum();
            $categors = $insertCategoriaController->listcategors();
            $citas    = $insertCitaController->listCitas();
            $estados  = $insertestadoController->listEstados();
            include './views/insert_User.php';
        }
        break;

    case 'insertTipDocum':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertTipDocumController->insertTipDocum();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            $docums = $insertTipDocumController->listTipDocum();
            include './views/insertTipDocum.php';
        }
        break;

    case 'insertBarbero':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertBarberoController->insertBarbero();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            include './views/insertBarbero.php';
        }
        break;

    case 'insertCategoria':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertCategoriaController->insertCategoria();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            $categorias = $insertCategoriaController->listcategors();
            include './views/insertCategoria.php';
        }
        break;

    case 'insertMarca':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertMarcaController->insertMarca();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            $marcas = $insertMarcaController->listMarca();
            include './views/insertMarca.php';
        }
        break;

    case 'insertProveedor':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertProveedorController->insertProveedor();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            include './views/insertProveedor.php';
        }
        break;

    case 'insertServicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertServicioController->insertServicio();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            include './views/insertServicio.php';
        }
        break;

    case 'insertestado':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertestadoController->insertestado();
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            include './views/insertestado.php';
        }
        break;

    case 'insertProducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $producs = $insertProductoController->insertProducto();
            include './views/dashboard.php';
        } else {
            $marcas     = $insertMarcaController->listMarca();
            $categorias = $insertCategoriaController->listcategors();
            include './views/insertProducto.php';
        }
        break;

    case 'insertCita':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertCitaController->insertCita();
        } else {
            $barberos  = $insertBarberoController->listBarbers();
            $estados   = $insertestadoController->listEstados();
            $servicios = $insertServicioController->listServicios();
            include './views/insertCita.php';
        }
        break;

    case 'insertdetalleventproducto':
        $productos       = $insertProductoController->listProductos();
        $ventasproductos = $insertventaproductoController->getVentasProductos();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $subTotal = $insertdetalleventproductoController->insertdetalleventproducto();
        }
        include './views/insertdetalleventproducto.php';
        break;

    case 'insertdetalleventservicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $detalls = $insertdetalleventservicioController->insertdetalleventservicio();
            include './views/dashboard.php';
        } else {
            $servicios      = $insertServicioController->listServicios();
            $ventasservicios = $insertventaservicioController->listventaservicio();
            include './views/insertdetalleventservicio.php';
        }
        break;

    case 'insertproveedorproducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proveedorproducs = $insertproveedorproductoController->insertproveedorproducto();
            include './views/dashboard.php';
        } else {
            $nitproveedors = $insertProveedorController->listProveedores();
            $productos     = $insertProductoController->listProductos();
            include './views/insertproveedorproducto.php';
        }
        break;

    case 'insertventaproducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertventaproductoController->insertventaproducto();
            include './views/dashboard.php';
        } else {
            include './views/insertventaproducto.php';
        }
        break;

    case 'insertventaservicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertventaservicioController->insertventaservicio();
            include './views/dashboard.php';
        } else {
            include './views/insertventaservicio.php';
        }
        break;


    case 'openFormDelete':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userController->eliminar();
    }
    $users = $userController->getUsers(); 
    include './views/delete_user_By_Num_Docum.php';
    break;

    case 'openFormDeleteTipDocum':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertTipDocumController->eliminar();
        }
        $tips = $insertTipDocumController->getTipDocum();
        require_once './views/delete_tipdocum.php';
        break;

    case 'openFormDeleteBarbero':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertBarberoController->eliminar();
        }
        $barbers = $insertBarberoController->listBarbers();
        include './views/delete_barbero.php';
        break;

    case 'openFormDeleteCategoria':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertCategoriaController->eliminar();
        }
        $categorias = $insertCategoriaController->listcategors();
        include './views/delete_categoria.php';
        break;

    case 'openFormDeleteMarca':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertMarcaController->eliminar();
        }
        $marcas = $insertMarcaController->listMarca();
        include './views/delete_marca.php';
        break;

    case 'openFormDeleteProveedor':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertProveedorController->eliminar();
        }
        $proveedores = $insertProveedorController->listProveedores();
        include './views/delete_proveedor.php';
        break;

    case 'openFormDeleteServicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertServicioController->eliminar();
        }
        $servicios = $insertServicioController->listServicios();
        include './views/delete_servicio.php';
        break;

    case 'openFormDeleteEstado':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertestadoController->eliminar();
        }
        $estados = $insertestadoController->listEstados();
        include './views/delete_estado.php';
        break;

    case 'openFormDeleteProducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertProductoController->eliminar();
        }
        $productos = $insertProductoController->listProductos();
        include './views/delete_producto.php';
        break;

    case 'openFormDeleteCita':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertCitaController->eliminar();
        }
        $citas = $insertCitaController->listCitas();
        include './views/delete_cita.php';
        break;

    case 'openFormDeleteDetalleVentProducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertdetalleventproductoController->eliminar();
        }
        $detallesvents = $insertdetalleventproductoController->listdetalleventaproductos();
        include './views/delete_detalleventproducto.php';
        break;

    case 'openFormDeleteDetalleVentServicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertdetalleventservicioController->eliminar();
        }
        $detalles = $insertdetalleventservicioController->listdetalleventaservicios();
        include './views/delete_detalleventservicio.php';
        break;

    case 'openFormDeleteProveedorProducto':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertproveedorproductoController->eliminar();
        }
        $proveedoresproductos = $insertproveedorproductoController->listproveedorproducto();
        include './views/delete_proveedorproducto.php';
        break;

    case 'openFormDeleteVentaProducto':
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $insertventaproductoController->eliminar();
    }
    $ventasproductos = $insertventaproductoController->openFormDeleteVentaProducto();
    include './views/delete_ventaproducto.php';
    break;

    case 'openFormDeleteVentaServicio':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $insertventaservicioController->eliminar();
        }
        $ventasservicios = $insertventaservicioController->listventaservicio();
        include './views/delete_ventaservicio.php';
        break;


    case "listUsers":
        $users = $userController->getUsers();
        include './views/list_users.php';
        break;

    case "searchUserByName":
        $users = $userController->UsersByName();
        include "./views/list_user_By_name_Form.php";
        break;

    case "listbarbers":
        $barbers = $insertBarberoController->listbarbers();
        include "./views/list_barberos.php";
        break;


    case "listMensajes":
        $contactos = $contactoController->listar();
        include "./views/list_mensajes.php";
        break;

    case "eliminarMensaje":
        $contactoController->eliminarMensaje();
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
        $categors = $insertCategoriaController->categorByName();
        include "./views/list_categoria_By_categoria_Form.php";
        break;

    case "listServicios":
        $servicios = $insertServicioController->listServicios();
        include "./views/list_servicio.php";
        break;

    case "searchServicioByName":
        $servicios = $insertServicioController->ServicioByName();
        include "./views/list_servicio_By_servicio_form.php";
        break;

    case "listEstados":
        $estados = $insertestadoController->listEstados();
        include "./views/list_estados.php";
        break;

    case "listProductos":
        $producs = $insertProductoController->listProductos();
        include "./views/list_productos.php";
        break;

    case "searchProductoByProducto":
        if (isset($_POST['nomProduc'])) {
            $producs   = $insertProductoController->ProductoByProducto();
            $buscando  = true;
        } else {
            $productos = $insertProductoController->listProductos();
            $buscando  = false;
        }
        include "./views/list_producto_By_producto_form.php";
        break;

    case "listCitas":
        $cits = $insertCitaController->listCitas();
        include "./views/list_citas.php";
        break;

    case "searchCitaByNumDocum":
        $cits = $insertCitaController->CitaByNumDocum();
        include "./views/list_citas_By_numDocum_Form.php";
        break;

    case "listdetalleventaproducto":
        $detallesp = $insertdetalleventproductoController->listdetalleventaproductos();
        include './views/list_detalleventaproducto.php';
        break;

    case "searchDetalleVentaProducto":
        $detallesp = $insertdetalleventproductoController->searchDetalleVentaProducto();
        include "./views/list_detalleventaproducto_By_iddetallevent_Form.php";
        break;

    case "listdetalleventservicio":
        $detalles = $insertdetalleventservicioController->listdetalleventaservicios();
        include './views/list_detalleventaservicio.php';
        break;

    case "searchDetalleVentaServicio":
        $detalles = $insertdetalleventservicioController->searchDetalleVentaServicio();
        include "./views/list_detalleventaservicio_By_iddetalle_Form.php";
        break;

    case "listproveedorproducto":
        $proveedorproducs = $insertproveedorproductoController->listproveedorproducto();
        include './views/list_proveedorproducto.php';
        break;

    case "searchproveedorproducto":
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['idProveProduc'])) {
        $proveedorproducs = $insertproveedorproductoController->searchproveedorproducto();
    } else {
       
        $proveedorproducs = $insertproveedorproductoController->listproveedorproducto();
    }
    include "./views/list_proveedorproducto_By_idproveproduc_Form.php";
    break;

    case "listventaproducto":
        $ventaproductos = $insertventaproductoController->listventaproducto();
        include './views/list_ventaproducto.php';
        break;

    case "searchventaproducto":
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['idVentaProducto'])) {
        $ventaproductos = $insertventaproductoController->searchventaproducto();
    } else {
       
        $ventaproductos = $insertventaproductoController->listventaproducto();
    }
    include "./views/list_ventaproducto_By_idventaproducto_Form.php";
    break;

    case "listventaservicio":
        $ventaservicios = $insertventaservicioController->listventaservicio();
        include './views/list_ventaservicio.php';
        break;

    case "searchventaservicio":
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['idVentaServi'])) {
        $ventaservicios = $insertventaservicioController->searchventaservicio();
    } else {
        $ventaservicios = $insertventaservicioController->listventaservicio();
    }
    include "./views/list_ventaservicio_By_idventaservicio_Form.php";
    break;

    

    case "searchDetalleVentProductoById":
       
        $detallesp = $insertdetalleventproductoController->searchDetalleVentaProducto();
        include "./views/list_detalleventaproducto_By_iddetallevent_Form.php";
        break;

    case "searchDetalleVentServicioById":
     
        $detalles = $insertdetalleventservicioController->searchDetalleVentaServicio();
        include "./views/list_detalleventaservicio_By_iddetalle_Form.php";
        break;

    case "searchProveedorProductoById":
        
        $proveedorProductos = $insertproveedorproductoController->searchproveedorproducto();
        include "./views/list_proveedorproducto_By_idproveproduc_Form.php";
        break;

    case "searchVentaProductoById":
        
        $ventas = $insertventaproductoController->searchventaproducto();
        include "./views/list_ventaproducto_By_idventaproducto_Form.php";
        break;

    case "searchVentaServicioById":
      
        $ventas = $insertventaservicioController->searchventaservicio();
        include "./views/list_ventaservicio_By_idventaservicio_Form.php";
        break;

 

    case "openFormUpdate":
        $users  = [];
        $docums = $insertTipDocumController->listTipDocum();
        include "./views/update_user.php";
        break;

    case "searchUserByNumDocum":
        $users  = $userController->UserByNumDocum();
        $docums = $insertTipDocumController->listTipDocum();
        include "./views/update_user.php";
        break;

    case "actualizar":
        $users = $userController->actualizar();
        include "./views/dashboard.php";
        break;

    case "openFormUpdateTipDocum":
        $editarDatos = [];
        include "./views/update_tipdocum.php";
        break;

    case "searchTipDocum":
        $editarDatos = $insertTipDocumController->buscarPorTipo() ?? [];
        include "./views/update_tipdocum.php";
        break;

    case "updateTipDocum":
        $insertTipDocumController->actualizar();
        $editarDatos = [];
        include "./views/update_tipdocum.php";
        break;

    case "openFormUpdateBarbero":
        $barbers = [];
        include "./views/update_barbero.php";
        break;

    case "searchBarberForUpdate":
        $barbers = $insertBarberoController->BarberByName();
        include "./views/update_barbero.php";
        break;

    case "actualizarBarbero":
        $insertBarberoController->actualizarBarbero();
        break;

    case "openFormUpdateCategoria":
        $categorias = [];
        include "./views/update_categoria.php";
        break;

    case "searchCategoriaByName":
        $categorias = $insertCategoriaController->categorByName();
        include "./views/update_categoria.php";
        break;

    case "actualizarCategoria":
        $insertCategoriaController->actualizarCategoria();
        break;

    case "openFormUpdateMarca":
        $marcas = [];
        include "./views/update_marca.php";
        break;

    case "searchMarcaByName":
        $marcas = $insertMarcaController->MarcaBymarca();
        include "./views/update_marca.php";
        break;

    case "actualizarMarca":
        $insertMarcaController->actualizarMarca();
        break;

    case "openFormUpdateProveedor":
        $proveedores = [];
        include "./views/update_proveedor.php";
        break;

    case "searchProveedorForUpdate":
        $proveedores = $insertProveedorController->ProveedorByName();
        include "./views/update_proveedor.php";
        break;

    case "actualizarProveedor":
        $insertProveedorController->actualizarProveedor();
        break;

    case "openFormUpdateServicio":
        $servicios = [];
        include "./views/update_servicio.php";
        break;

    case "searchServicioForUpdate":
        $servicios = $insertServicioController->ServicioByName();
        include "./views/update_servicio.php";
        break;

    case "actualizarServicio":
        $insertServicioController->actualizarServicio();
        break;

    case "openFormUpdateEstado":
        $estados = [];
        include "./views/update_estado.php";
        break;

    case "searchEstadoByName":
        $estados = $insertestadoController->estadoByName();
        include "./views/update_estado.php";
        break;

    case "actualizarEstado":
        $insertestadoController->actualizarEstado();
        break;

    case "openFormUpdateProducto":
        $productos = [];
        include "./views/update_producto.php";
        break;

    case "searchProductoByName":
        $productos = $insertProductoController->ProductoByProducto();
        include "./views/update_producto.php";
        break;

    case "actualizarProducto":
        $insertProductoController->actualizarProducto();
        break;

    case "openFormUpdateCita":
        $citas = [];
        include "./views/update_cita.php";
        break;

    case "searchCitaByNumDocumUpdate":
        $citas = $insertCitaController->CitaByNumDocum();
        include "./views/update_cita.php";
        break;

    case "actualizarCita":
        $insertCitaController->actualizarCita();
        break;

    case "openFormUpdateDetalleVentProducto":
        $detalles = [];
        include "./views/update_detalleventproducto.php";
        break;


    case "searchDetalleVentProductoByIdForUpdate":
        $detalles = $insertdetalleventproductoController->searchDetalleVentaProducto();
        include "./views/update_detalleventproducto.php";
        break;

    case "actualizarDetalleVentProducto":
        $insertdetalleventproductoController->actualizarDetalleVentProducto();
        break;

    case "openFormUpdateDetalleVentServicio":
        $detalles = [];
        include "./views/update_detalleventservicio.php";
        break;

    
    case "searchDetalleVentServicioByIdForUpdate":
        $detalles = $insertdetalleventservicioController->searchDetalleVentaServicioByIdDetalle();
        include "./views/update_detalleventservicio.php";
        break;

    case "actualizarDetalleVentServicio":
        $insertdetalleventservicioController->actualizarDetalleVentServicio();
        break;

    case "openFormUpdateProveedorProducto":
        $proveedorProductos = [];
        include "./views/update_proveedorproducto.php";
        break;

    
    case "searchProveedorProductoByIdForUpdate":
        $proveedorProductos = $insertproveedorproductoController->searchproveedorproducto();
        include "./views/update_proveedorproducto.php";
        break;

    case "openFormUpdateVentaProducto":
        $ventas = [];
        include "./views/update_ventaproducto.php";
        break;

    case "searchVentaProductoByIdForUpdate":
        $ventas = $insertventaproductoController->searchventaproducto();
        include "./views/update_ventaproducto.php";
        break;

    case "openFormUpdateVentaServicio":
        $ventas = [];
        include "./views/update_ventaservicio.php";
        break;


    case "searchVentaServicioByIdForUpdate":
        $ventas = $insertventaservicioController->searchventaservicio();
        include "./views/update_ventaservicio.php";
        break;

    case "actualizarVentaServicio":
        $insertventaservicioController->actualizarVentaServicio();
        break;


    case 'recuperar_password':
        include './views/recuperar_password.php';
        break;

    case 'sendResetEmail':
        require_once './controllers/PasswordResetController.php';
        break;

    case 'sendMailView':
        include './views/send_mail.php';
        break;

    case 'resetPassword':
        include './views/reste_password.php';
        break;

    case 'updatePassword':
        require_once './controllers/UpdatePasswordController.php';
        break;

    case 'dashboard':
        include './views/dashboard.php';
        break;

    case 'login1':
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=dashboard");
            exit();
        }
        include './views/login.php';
        break;

 case 'logout':
    setcookie('g_state', '', time() - 3600, '/');
    session_unset();
    session_destroy();
    header("Location: index.php?action=login1&logout=success&google_signout=1");
    exit();
    break;

    case 'checkout':
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login1&msg=cita");
            exit();
        }
        include './views/checkout.php';
        break;

 case 'procesarVenta':

    if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: index.php?action=productobarberia");
        exit();
    }

    require_once './config/database.php';
    $database = new Database();
    $conn = $database->getConnection();

    
    $numDocum      = $_POST['numDocum'] ?? null;
    $nombreComplet = $_POST['nombreComplet'] ?? null;
    $correo        = $_POST['correo'] ?? null;
    $direccion     = $_POST['direccion'] ?? null;
    $Telefono      = $_POST['Telefono'] ?? null;
    $total         = $_POST['total'] ?? 0;
    $metodoPago    = $_POST['metodoPago'] ?? null;
    $items         = isset($_POST['itemsCarrito']) 
                        ? json_decode($_POST['itemsCarrito'], true) 
                        : [];

    // Si numDocum esta vacio o negativo (usuario Google sin documento real),
    // intentar recuperarlo de la sesion.
    if (empty($numDocum) || (int)$numDocum < 0) {
        $numDocum = $_SESSION['user']['numDocum'] ?? $_SESSION['numDocum'] ?? null;
    }

    // Verificar que el numDocum exista realmente en la tabla cliente
    $numDocumValido = false;
    if (!empty($numDocum) && (int)$numDocum > 0) {
        $stmtChk = $conn->prepare("SELECT numDocum FROM cliente WHERE numDocum = ? LIMIT 1");
        $stmtChk->execute([$numDocum]);
        if ($stmtChk->fetch()) {
            $numDocumValido = true;
        }
    }

    if (!$numDocumValido) {
        // El usuario no tiene documento valido (p.ej. registro con Google)
        header("Location: index.php?action=completarPerfil&msg=necesitas_documento");
        exit();
    }

    if (!$metodoPago || empty($items)) {
        header("Location: index.php?action=checkout&error=datos_incompletos");
        exit();
    }

    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');
    $hora  = date('H:i:s');

    try {

        $conn->beginTransaction();

     
        $sqlUpdate = "UPDATE cliente 
                      SET nombreComplet = ?, 
                          correo = ?, 
                          direccion = ?, 
                          Telefono = ?
                      WHERE numDocum = ?";

        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->execute([
            $nombreComplet,
            $correo,
            $direccion,
            $Telefono,
            $numDocum
        ]);

        
        $stmtVenta = $conn->prepare(
            "INSERT INTO ventaproducto (fecha, hora, total, numDocum) 
             VALUES (?, ?, ?, ?)"
        );

        $stmtVenta->execute([$fecha, $hora, $total, $numDocum]);
        $idVenta = $conn->lastInsertId();

        
        foreach ($items as $item) {

            
            $idProducto = $item['idProducto'] ?? null;

            if (!$idProducto) {
                $stmtP = $conn->prepare("SELECT idProducto FROM producto WHERE nomProduc = ? LIMIT 1");
                $stmtP->execute([$item['nombre']]);
                $prod = $stmtP->fetch(PDO::FETCH_ASSOC);
                $idProducto = $prod['idProducto'] ?? null;
            }

            if ($idProducto) {

                
                $stmtStock = $conn->prepare("SELECT cantidad FROM producto WHERE idProducto = ? FOR UPDATE");
                $stmtStock->execute([$idProducto]);
                $stockActual = $stmtStock->fetchColumn();

                if ($stockActual < $item['cantidad']) {
                    $conn->rollBack();
                    echo "<script>alert('Stock insuficiente para \"" . addslashes($item['nombre']) . "\". Solo quedan $stockActual unidades.'); window.location.href='index.php?action=checkout';</script>";
                    exit();
                }

                $subTotal = $item['precio'] * $item['cantidad'];

                
                $stmtD = $conn->prepare(
                    "INSERT INTO detalleventproducto 
                     (idVentaProducto, cantidad, precioUnitario, subTotal, idProducto) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                $stmtD->execute([
                    $idVenta,
                    $item['cantidad'],
                    $item['precio'],
                    $subTotal,
                    $idProducto
                ]);

                
                $stmtDesc = $conn->prepare("UPDATE producto SET cantidad = cantidad - ? WHERE idProducto = ?");
                $stmtDesc->execute([$item['cantidad'], $idProducto]);
            }
        }

        $conn->commit();


        $_SESSION['factura'] = [
            'idVenta'    => $idVenta,
            'fecha'      => $fecha,
            'hora'       => $hora,
            'total'      => $total,
            'metodoPago' => $metodoPago,
            'nombre'     => $nombreComplet,
            'numDocum'   => $numDocum,
            'correo'     => $correo,
            'direccion'  => $direccion,
            'Telefono'   => $Telefono,
            'items'      => $items,
        ];


        $_SESSION['user']['correo']    = $correo;
        $_SESSION['user']['direccion'] = $direccion;
        $_SESSION['user']['Telefono']  = $Telefono;
        $_SESSION['nombreComplet']     = $nombreComplet;

        header("Location: index.php?action=factura");
        exit();

    } catch (Exception $e) {

        $conn->rollBack();
        echo "Error en la venta: " . $e->getMessage();
        exit();
    }

    break;

    case 'factura':
        if (!isset($_SESSION['factura'])) {
            header("Location: index.php?action=productobarberia");
            exit();
        }
        include './views/factura.php';
        break;

    case 'misPedidos':
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login1");
            exit();
        }
        include './views/mis_pedidos.php';
        break;

    /* ── DEVOLUCIONES ── */
    case 'solicitarDevolucion':
        require_once './controllers/DevolucionController.php';
        $devCtrl = new DevolucionController();
        $devCtrl->mostrarFormulario();
        break;

    case 'procesarDevolucion':
        require_once './controllers/DevolucionController.php';
        $devCtrl = new DevolucionController();
        $devCtrl->procesarSolicitud();
        break;

    case 'adminDevoluciones':
        require_once './controllers/DevolucionController.php';
        $devCtrl = new DevolucionController();
        $devCtrl->listarAdmin();
        break;

    case 'actualizarDevolucion':
        require_once './controllers/DevolucionController.php';
        $devCtrl = new DevolucionController();
        $devCtrl->actualizarEstado();
        break;

    /* ── DESCARGAR FACTURA HISTORIAL ── */
    case 'descargarFactura':
        require_once './controllers/DevolucionController.php';
        $devCtrl = new DevolucionController();
        $devCtrl->descargarFactura();
        break;

    case 'register':
        $registerController->showRegisterForm();
        break;

    case 'registerUser':
        $registerController->registerUser();
        break;

    case 'buscarProducto':
        require_once './controllers/insertProductoController.php';
        $controller = new insertProductoController();
        $controller->buscar();
        break;

        case 'googleLogin':
    $userController->googleLogin();
    break;

case 'googleCallback':
    include './views/googleCallback.php';
    break;

case 'completarPerfil':
    // if (!isset($_SESSION['user'])) {
    //     header("Location: index.php?action=login1");
    //     exit();
    // }
    include './views/completarPerfil.php';
    break;

case 'guardarPerfil':
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=login1");
        exit();
    }
    require_once 'config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    $idCliente = $_SESSION['user']['idCliente'] ?? $_SESSION['user']['numDocum'] ?? null;
    $telefono  = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $idtipoDoc = $_POST['idtipoDoc'] ?? null;
    $numDocum  = $_POST['numDocum'] ?? '';

    
    $correo = $_SESSION['user']['correo'];
    $contrasena = $_POST['contraseña'] ?? $_POST['contrasena'] ?? '';

    $sql = "UPDATE cliente SET Telefono = :tel, direccion = :dir, idtipoDoc = :tipo";
    $params = [':tel' => $telefono, ':dir' => $direccion, ':tipo' => $idtipoDoc, ':correo' => $correo];

    if (!empty($numDocum)) {
        $sql .= ", numDocum = :numDocum";
        $params[':numDocum'] = $numDocum;
    }
    if (!empty($contrasena)) {
        $sql .= ", password = :password";
        $params[':password'] = $contrasena;
    }
    $sql .= " WHERE correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    
    require_once 'model/UserModel.php';
    $userModel = new UserModel($conn);
    $updatedUser = $userModel->buscarPorEmail($correo);
    $_SESSION['user'] = $updatedUser;
    $_SESSION['rol'] = 'cliente';
    $_SESSION['nombreComplet'] = $updatedUser['nombreComplet'];

    header("Location: index.php?action=principal");
    exit();
    break;
case 'actualizarDatos':

    require_once 'config/database.php';
    $database = new Database();
    $conn = $database->getConnection();

    $sql = "UPDATE cliente 
            SET nombreComplet = :nombreComplet,
                correo = :correo,
                direccion = :direccion,
                Telefono = :Telefono
            WHERE numDocum = :numDocum";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nombreComplet' => $_POST['nombreComplet'],
        ':correo'        => $_POST['correo'],
        ':direccion'     => $_POST['direccion'],
        ':Telefono'      => $_POST['Telefono'],
        ':numDocum'      => $_POST['numDocum']
    ]);

    $_SESSION['user']['correo'] = $_POST['correo'];
    $_SESSION['user']['direccion'] = $_POST['direccion'];
    $_SESSION['user']['Telefono'] = $_POST['Telefono'];
    $_SESSION['nombreComplet'] = $_POST['nombreComplet'];

    header("Location: index.php?action=factura");
    exit();

    default:
        include './views/login.php';
        break;
}

?>