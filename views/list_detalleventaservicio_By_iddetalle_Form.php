<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Detalles de Venta de Servicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Buscar Detalles de Venta de Servicio</h2>

    <div class="volver-form mb-4">
        <form action="index.php?action=searchDetalleVentaServicio" method="post">
            <input type="hidden" name="action" value="searchDetalleVentaServicio">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label for="idVentaServi" class="form-label mb-0" style="color:#d4af37; font-weight:600;">ID Venta Servicio:</label>
                <input type="text" name="idVentaServi" id="idVentaServi" required
                    class="form-control w-auto" style="background:#232323; color:#fff; border-color:#d4af37;">
                <button type="submit" class="btn-dashboard">Buscar</button>
            </div>
        </form>
        <form action="index.php?action=searchDetalleVentaServicio" method="POST" style="margin-top:10px;">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
    </div>

    <?php if (isset($detalles) && count($detalles) > 0): ?>

        <h3 class="titulo mb-3" style="font-size:1.2rem;">Resultado de la búsqueda</h3>

        <div class="tabla-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>Venta Servicio</th>
                        <th>Precio Unitario</th>
                        <th class="d-none d-md-table-cell">Servicio</th>
                        <th class="d-none d-md-table-cell">Fecha</th>
                        <th class="d-none d-md-table-cell">Hora</th>
                        <th class="d-none d-md-table-cell">Nº Documento Cliente</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $detalle): ?>
                    <tr>
                        <td><?= htmlspecialchars($detalle['idVentaServi']) ?></td>
                        <td><?= htmlspecialchars($detalle['precioUnitario']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($detalle['nombreServi']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($detalle['fecha']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($detalle['hora']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($detalle['numDocum']) ?></td>
                        <td><?= htmlspecialchars($detalle['total']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif (isset($detalles)): ?>
        <p style="color:#d4af37;">No se encontraron detalles de venta de servicio con ese ID.</p>
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
