<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Detalle Venta Servicio</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h1 class="titulo mb-4">Insertar Detalle Venta Servicio</h1>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=insertdetalleventservicio" method="POST">

                <label>Precio Unitario:</label>
                <input type="number" name="precioUnitario" min="0" required>

                <label>Servicio:</label>
                <select name="idServicio">
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?= $servicio['idServicio']; ?>"><?= $servicio['nombreServi']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Venta Servicio:</label>
                <select name="idVentaServi" required>
                    <option value="" disabled selected>Seleccione una venta...</option>
                    <?php if (!empty($ventasservicios)): ?>
                        <?php foreach ($ventasservicios as $ventas): ?>
                            <option value="<?= $ventas['idVentaServi']; ?>">
                                Venta: <?= $ventas['idVentaServi']; ?> - <?= $ventas['nombreComplet']; ?> - $<?= number_format($ventas['total'], 0, ',', '.'); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>No hay ventas registradas</option>
                    <?php endif; ?>
                </select>

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

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
