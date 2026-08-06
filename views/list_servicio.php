<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4">

    <h2 class="titulo mb-4">Servicios</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>Nombre del Servicio</th>
                    <th class="d-none d-md-table-cell">Precio Unitario</th>
                    <th class="d-none d-md-table-cell">Duración</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?= htmlspecialchars($servicio["nombreServi"]) ?></td>
                    <td class="d-none d-md-table-cell">$<?= number_format($servicio["precioUni"], 0, ',', '.') ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($servicio["duracion"]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
