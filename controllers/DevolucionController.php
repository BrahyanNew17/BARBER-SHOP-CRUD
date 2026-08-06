<?php

require_once __DIR__ . '/../model/DevolucionModel.php';
require_once __DIR__ . '/../config/database.php';

class DevolucionController {

    private DevolucionModel $model;

    public function __construct() {
        $db   = new Database();
        $conn = $db->getConnection();
        $this->model = new DevolucionModel($conn);
    }

    public function mostrarFormulario(): void {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login1");
            exit();
        }

        $numDocum = $_SESSION['user']['numDocum'] ?? $_SESSION['numDocum'] ?? '';
        $pedidos  = $this->model->getPedidosCliente($numDocum);
        $devolucionesActivas = $this->model->getDevolucionesCliente($numDocum);

        include './views/solicitar_devolucion.php';
    }

    public function procesarSolicitud(): void {
        if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=login1");
            exit();
        }

        $numDocum   = $_SESSION['user']['numDocum'] ?? $_SESSION['numDocum'] ?? '';
        $idVenta    = (int)($_POST['idVentaProducto'] ?? 0);
        $motivo     = trim($_POST['motivo'] ?? '');
        $productos  = $_POST['productos'] ?? [];   

        
        if ($idVenta <= 0 || empty($motivo) || empty($productos)) {
            header("Location: index.php?action=solicitarDevolucion&error=datos_incompletos");
            exit();
        }

        if (!$this->model->verificarPertenencia($idVenta, $numDocum)) {
            header("Location: index.php?action=solicitarDevolucion&error=no_autorizado");
            exit();
        }

        
        foreach ($productos as $prod) {
            $idProducto = (int)($prod['idProducto'] ?? 0);
            $cantidad   = (int)($prod['cantidadDevuelta'] ?? 0);

            if ($idProducto <= 0 || $cantidad <= 0) continue;

            if ($this->model->yaExisteDevolucion($idVenta, $idProducto)) {
                header("Location: index.php?action=solicitarDevolucion&error=ya_existe");
                exit();
            }

            $this->model->crear($idVenta, $idProducto, $cantidad, $motivo);
        }

        header("Location: index.php?action=solicitarDevolucion&success=1");
        exit();
    }

  
    public function listarAdmin(): void {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?action=principal");
            exit();
        }

        $devoluciones = $this->model->getTodas();
        include './views/admin_devoluciones.php';
    }


    public function actualizarEstado(): void {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=principal");
            exit();
        }

        $idDevolucion = (int)($_POST['idDevolucion'] ?? 0);
        $estado       = $_POST['estado'] ?? '';
        $observacion  = trim($_POST['observacion'] ?? '');

        $estadosValidos = ['Aprobada', 'Rechazada'];
        if ($idDevolucion <= 0 || !in_array($estado, $estadosValidos)) {
            header("Location: index.php?action=adminDevoluciones&error=datos");
            exit();
        }

        $this->model->actualizarEstado($idDevolucion, $estado, $observacion);
        header("Location: index.php?action=adminDevoluciones&success=1");
        exit();
    }

  
    public function descargarFactura(): void {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login1");
            exit();
        }

        $idVenta  = (int)($_GET['id'] ?? 0);
        $numDocum = $_SESSION['user']['numDocum'] ?? $_SESSION['numDocum'] ?? '';

        if ($idVenta <= 0) {
            header("Location: index.php?action=misPedidos&error=id_invalido");
            exit();
        }

        $venta = $this->model->getVentaParaFactura($idVenta, $numDocum);

        if (!$venta) {
            header("Location: index.php?action=misPedidos&error=no_encontrado");
            exit();
        }

        include './views/descargar_factura.php';
    }
}