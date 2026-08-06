<?php if (!isset($base)) { $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); } ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Barber Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <link rel="stylesheet" href="<?= $base ?>/css/dashboard.css">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
   
</head>
<?php include 'includes/header.php'; ?>

<body>

    <?php
    $rol          = $_SESSION['rol'] ?? 'cliente';
    $nombreComplet = $_SESSION['nombreComplet'] ?? $_SESSION['user']['nombreComplet'] ?? 'Usuario';
    $inicial      = strtoupper(mb_substr($nombreComplet, 0, 1));
    $esAdmin      = ($rol === 'admin' || $rol === 'barbero');
    $esCliente    = ($rol === 'cliente');
    ?>

    <br><br><br><br><br>
    <div class="dash-hero">
        <div class="dash-hero-left">
            <div class="user-avatar"><?= $inicial ?></div>
            <div class="user-meta">
                <p class="welcome">Panel de control</p>
                <h1><?= htmlspecialchars($nombreComplet) ?></h1>
                <span class="rol-badge rol-<?= htmlspecialchars($rol) ?>">
                    <?= $rol === 'admin' ? 'Administrador' : ($rol === 'barbero' ? 'Barbero' : 'Cliente') ?>
                </span>
            </div>
        </div>
        <div class="dash-hero-actions">
            <?php if ($esCliente): ?>
                <form action="index.php?action=openFormUpdate" method="POST">
                    <button type="submit" class="logout-btn secondary" style="font-size:14px; padding:10px 20px;">
                        Actualizar Perfil
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="dash-tabs">
        <a class="dash-tab active" onclick="switchTab('insertar')" href="#">
            <?= $esAdmin ? 'Insertar' : 'Nueva Cita' ?>
        </a>
        <a class="dash-tab" onclick="switchTab('consultar')" href="#">
            Consultar
        </a>
        <?php if ($esAdmin): ?>
            <a class="dash-tab" onclick="switchTab('eliminar')" href="#">
                Eliminar
            </a>
            <a class="dash-tab" onclick="switchTab('actualizar')" href="#">
                Actualizar
            </a>
        <?php else: ?>
            <a class="dash-tab" onclick="switchTab('eliminar')" href="#">
                Eliminar
            </a>
            <a class="dash-tab" onclick="switchTab('actualizar')" href="#">
                Actualizar
            </a>

        <?php endif; ?>
    </div>

    <div id="tab-insertar" class="dash-section active">
        <div class="actions-grid">

            <?php if ($esAdmin): ?>
                <?php
                $inserts = [
                    ['action' => 'insertUser',                   'label' => 'Insertar Cliente'],
                    ['action' => 'insertTipDocum',               'label' => 'Insertar Tipo de Documento'],
                    ['action' => 'insertBarbero',                'label' => 'Insertar Barbero'],
                    ['action' => 'insertCategoria',              'label' => 'Insertar Categoría'],
                    ['action' => 'insertMarca',                  'label' => 'Insertar Marca'],
                    ['action' => 'insertProveedor',              'label' => 'Insertar Proveedor'],
                    ['action' => 'insertServicio',               'label' => 'Insertar Servicio'],
                    ['action' => 'insertestado',                 'label' => 'Insertar Estado'],
                    ['action' => 'insertProducto',               'label' => 'Insertar Producto'],
                    ['action' => 'insertCita',                   'label' => 'Insertar Cita'],
                    ['action' => 'insertdetalleventproducto',    'label' => 'Insertar Det. Venta Producto'],
                    ['action' => 'insertdetalleventservicio',    'label' => 'Insertar Det. Venta Servicio'],
                    ['action' => 'insertproveedorproducto',      'label' => 'Insertar Proveedor Producto'],
                    ['action' => 'insertventaproducto',          'label' => 'Insertar Venta Producto'],
                    ['action' => 'insertventaservicio',          'label' => 'Insertar Venta Servicio'],
                ];
                foreach ($inserts as $item): ?>
                    <form class="action-form" action="index.php?action=<?= $item['action'] ?>" method="GET">
                        <button type="submit" name="action" value="<?= $item['action'] ?>">

                            <span class="btn-label">
                                <?= $item['label'] ?>

                            </span>
                        </button>
                    </form>
                <?php endforeach; ?>

            <?php else: ?>
                <form class="action-form" action="index.php?action=insertCita" method="GET">
                    <button type="submit" name="action" value="insertCita">
                        
                        <span class="btn-label">
                            Reservar Cita

                        </span>
                    </button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <div id="tab-consultar" class="dash-section">
        <div class="actions-grid">

            <?php if ($esAdmin): ?>
                <?php
                $queries = [
                    ['action' => 'listUsers',                        'method' => 'GET', 'label' => 'Ver Clientes'],
                    ['action' => 'searchUserByName',                 'method' => 'GET', 'label' => 'Buscar Cliente'],
                    ['action' => 'listTipDocum',                     'method' => 'GET', 'label' => 'Ver Tipos de Documento'],
                    ['action' => 'listbarbers',                      'method' => 'GET', 'label' => 'Ver Barberos'],
                    ['action' => 'searchBarberByName',               'method' => 'POST', 'label' => 'Buscar Barbero'],
                    ['action' => 'listcategors',                     'method' => 'GET', 'label' => 'Ver Categorías'],
                    ['action' => 'searchcategorByName',              'method' => 'POST', 'label' => 'Buscar Categoría'],
                    ['action' => 'listMarca',                        'method' => 'GET', 'label' => 'Ver Marcas'],
                    ['action' => 'searchMarcaBymarca',               'method' => 'POST', 'label' => 'Buscar Marca'],
                    ['action' => 'listProveedores',                  'method' => 'GET', 'label' => 'Ver Proveedores'],
                    ['action' => 'searchProveedorByName',            'method' => 'POST', 'label' => 'Buscar Proveedor'],
                    ['action' => 'listServicios',                    'method' => 'GET', 'label' => 'Ver Servicios'],
                    ['action' => 'searchServicioByName',             'method' => 'POST', 'label' => 'Buscar Servicio'],
                    ['action' => 'listEstados',                      'method' => 'GET', 'label' => 'Ver Estados'],
                    ['action' => 'listProductos',                    'method' => 'GET', 'label' => 'Ver Productos'],
                    ['action' => 'searchProductoByProducto',         'method' => 'POST', 'label' => 'Buscar Producto'],
                    ['action' => 'listCitas',                        'method' => 'GET', 'label' => 'Ver Citas'],
                    ['action' => 'searchCitaByNumDocum',             'method' => 'GET', 'label' => 'Buscar Cita'],
                    ['action' => 'listdetalleventaproducto',         'method' => 'GET', 'label' => 'Ver Det. Venta Producto'],
                    ['action' => 'searchDetalleVentProductoById',    'method' => 'POST', 'label' => 'Buscar Det. V. Producto'],
                    ['action' => 'listdetalleventservicio',          'method' => 'GET', 'label' => 'Ver Det. Venta Servicio'],
                    ['action' => 'searchDetalleVentServicioById',    'method' => 'POST', 'label' => 'Buscar Det. V. Servicio'],
                    ['action' => 'listproveedorproducto',            'method' => 'GET', 'label' => 'Ver Proveedor Producto'],
                    ['action' => 'searchproveedorproducto',          'method' => 'POST', 'label' => 'Buscar Prov. Producto'],
                    ['action' => 'listventaproducto',                'method' => 'GET', 'label' => 'Ver Ventas Producto'],
                    ['action' => 'searchventaproducto',              'method' => 'POST', 'label' => 'Buscar Venta Producto'],
                    ['action' => 'listventaservicio',                'method' => 'GET',  'label' => 'Ver Ventas Servicio'],
                    ['action' => 'searchventaservicio',              'method' => 'POST', 'label' => 'Buscar Venta Servicio'],
                    ['action' => 'adminDevoluciones',                'method' => 'GET',  'label' => 'Gestionar Devoluciones'],
                    ['action' => 'listMensajes', 'method' => 'GET', 'label' => 'Ver Mensajes'],
                ];
                foreach ($queries as $item): ?>
                    <form class="action-form" action="index.php?action=<?= $item['action'] ?>" method="<?= $item['method'] ?>">
                        <?php if ($item['method'] === 'POST'): ?>
                            <input type="hidden" name="action" value="<?= $item['action'] ?>">
                        <?php endif; ?>
                        <button type="submit" <?= $item['method'] === 'GET' ? 'name="action" value="' . $item['action'] . '"' : '' ?>>
                            <span class="btn-label"><?= $item['label'] ?></span>
                        </button>
                    </form>
                <?php endforeach; ?>

            <?php else: ?>
                <!-- Solo para clientes -->
                <form class="action-form" action="index.php?action=listCitas" method="GET">
                    <button type="submit" name="action" value="listCitas">
                        <span class="btn-label">Mis Citas</span>
                    </button>
                </form>
                <form class="action-form" action="index.php?action=misPedidos" method="GET">
                    <button type="submit" name="action" value="misPedidos">
                        <span class="btn-label">Mis Pedidos</span>
                    </button>
                </form>
                <form class="action-form" action="index.php?action=solicitarDevolucion" method="GET">
                    <button type="submit" name="action" value="solicitarDevolucion">
                        <span class="btn-label">↩ Mis Devoluciones</span>
                    </button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <div id="tab-eliminar" class="dash-section">
        <div class="actions-grid">
            <?php if ($esAdmin): ?>
                <?php
                $deletes = [
                    ['action' => 'openFormDelete', 'label' => 'Eliminar Cliente'],
                    ['action' => 'openFormDeleteTipDocum', 'label' => 'Eliminar Tipo de Documento'],
                    ['action' => 'openFormDeleteBarbero', 'label' => 'Eliminar Barbero'],
                    ['action' => 'openFormDeleteCategoria', 'label' => 'Eliminar Categoría'],
                    ['action' => 'openFormDeleteMarca', 'label' => 'Eliminar Marca'],
                    ['action' => 'openFormDeleteProveedor', 'label' => 'Eliminar Proveedor'],
                    ['action' => 'openFormDeleteServicio', 'label' => 'Eliminar Servicio'],
                    ['action' => 'openFormDeleteEstado', 'label' => 'Eliminar Estado'],
                    ['action' => 'openFormDeleteProducto', 'label' => 'Eliminar Producto'],
                    ['action' => 'openFormDeleteCita', 'label' => 'Eliminar Cita'],
                    ['action' => 'openFormDeleteDetalleVentProducto', 'label' => 'Eliminar Det. Venta Producto'],
                    ['action' => 'openFormDeleteDetalleVentServicio',      'label' => 'Eliminar Det. Venta Servicio'],
                    ['action' => 'openFormDeleteProveedorProducto',        'label' => 'Eliminar Proveedor Producto'],
                    ['action' => 'openFormDeleteVentaProducto',            'label' => 'Eliminar Venta Producto'],
                    ['action' => 'openFormDeleteVentaServicio',            'label' => 'Eliminar Venta Servicio'],
                ];
                foreach ($deletes as $item): ?>
                    <form class="action-form" action="index.php?action=<?= $item['action'] ?>" method="POST">
                        <button type="submit">

                            <span class="btn-label">
                                <?= $item['label'] ?>

                            </span>
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php else: ?>
                <form class="action-form" action="index.php?action=openFormDeleteCita" method="POST">
                    <button type="submit">
                        
                        <span class="btn-label">Eliminar Cita<br></span>
                    </button>
                </form>

            <?php endif; ?>
        </div>
    </div>
    <div id="tab-actualizar" class="dash-section">
        <div class="actions-grid">
            <?php if ($esAdmin): ?>
                <?php
                $updates = [
                    ['action' => 'openFormUpdate', 'label' => 'Actualizar Cliente'],
                    ['action' => 'openFormUpdateTipDocum', 'label' => 'Actualizar Tipo de Documento'],
                    ['action' => 'openFormUpdateBarbero', 'label' => 'Actualizar Barbero'],
                    ['action' => 'openFormUpdateCategoria', 'label' => 'Actualizar Categoría'],
                    ['action' => 'openFormUpdateMarca', 'label' => 'Actualizar Marca'],
                    ['action' => 'openFormUpdateProveedor', 'label' => 'Actualizar Proveedor'],
                    ['action' => 'openFormUpdateServicio', 'label' => 'Actualizar Servicio'],
                    ['action' => 'openFormUpdateEstado', 'label' => 'Actualizar Estado'],
                    ['action' => 'openFormUpdateProducto', 'label' => 'Actualizar Producto'],
                    ['action' => 'openFormUpdateCita', 'label' => 'Actualizar Cita'],
                    ['action' => 'openFormUpdateDetalleVentProducto', 'label' => 'Actualizar Det. Venta Producto'],
                    ['action' => 'openFormUpdateDetalleVentServicio', 'label' => 'Actualizar Det. Venta Servicio'],
                    ['action' => 'openFormUpdateProveedorProducto', 'label' => 'Actualizar Proveedor Producto'],
                    ['action' => 'openFormUpdateVentaProducto', 'label' => 'Actualizar Venta Producto'],
                    ['action' => 'openFormUpdateVentaServicio', 'label' => 'Actualizar Venta Servicio'],
                ];
                foreach ($updates as $item): ?>
                    <form class="action-form" action="index.php?action=<?= $item['action'] ?>" method="POST">
                        <button type="submit">

                            <span class="btn-label">
                                <?= $item['label'] ?>

                            </span>
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php else: ?>

                <form class="action-form" action="index.php?action=openFormUpdateCita" method="POST">
                    <button type="submit">
                        
                        <span class="btn-label">Actualizar Cita</span>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        function switchTab(name) {

            document.querySelectorAll('.dash-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.dash-section').forEach(s => s.classList.remove('active'));

            document.getElementById('tab-' + name).classList.add('active');

            event.target.classList.add('active');

            return false;
        }
    </script>
</body>

</html>
