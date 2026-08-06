<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Ventas Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Buscar Ventas Productos</h2>

    <div class="volver-form mb-4">
        <form action="index.php?action=searchventaproducto" method="post">
            <input type="hidden" name="action" value="searchventaproducto">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label for="idVentaProducto" class="form-label mb-0" style="color:#d4af37; font-weight:600;">ID Venta Producto:</label>
                <input type="text" name="idVentaProducto" id="idVentaProducto"
                    class="form-control w-auto" style="background:#232323; color:#fff; border-color:#d4af37;"
                    value="<?= htmlspecialchars($_POST['idVentaProducto'] ?? '') ?>">
                <button type="submit" class="btn-dashboard">Buscar</button>
            </div>
        </form>
        <form action="index.php?action=searchventaproducto" method="POST" style="margin-top:10px;">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
    </div>

    <?php if (isset($ventaproductos) && count($ventaproductos) > 0): ?>

        <?php if (!empty($_POST['idVentaProducto'])): ?>
            <h3 class="titulo mb-3" style="font-size:1.2rem;">Resultado de la búsqueda</h3>
        <?php endif; ?>

        <div class="tabla-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">ID Venta</th>
                        <th>Fecha</th>
                        <th class="d-none d-md-table-cell">Hora</th>
                        <th>Total</th>
                        <th class="d-none d-md-table-cell">Nº Documento</th>
                        <th>Nombre Completo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventaproductos as $ventaproducto): ?>
                    <tr>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($ventaproducto['idVentaProducto']) ?></td>
                        <td><?= htmlspecialchars($ventaproducto['fecha']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($ventaproducto['hora']) ?></td>
                        <td><?= htmlspecialchars($ventaproducto['total']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($ventaproducto['numDocum']) ?></td>
                        <td><?= htmlspecialchars($ventaproducto['nombreComplet']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif (!empty($_POST['idVentaProducto'])): ?>
        <?php ?>
        <p style="color:#d4af37;">No se encontraron ventas de productos con ese ID.</p>
    <?php endif; ?>

    <div class="volver-form mt-4">
        <form action="index.php?action=dashboard" method="post">
            <button type="submit" name="action" value="dashboard" class="btn-dashboard">
                Dashboard
            </button>
        </form>
    </div>

</div>

</body>
</html>
