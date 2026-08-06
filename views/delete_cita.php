<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cita</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 450px;">

    <h1 class="titulo mb-4">Eliminar Cita</h1>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form class="form-eliminar" action="index.php?action=openFormDeleteCita" method="POST">
                <input type="hidden" name="action" value="openFormDeleteCita">
                <label>ID Cita:</label>
                <input type="text" name="idCita" required>
                <button type="submit" onclick="return confirm('¿Está seguro de eliminar esta cita?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <h2 class="titulo-secundario mb-3">Lista de Citas</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th class="d-none d-md-table-cell">Nº Documento</th>
                    <th class="d-none d-md-table-cell">Barbero</th>
                    <th>Estado</th>
                    <th>Servicio</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($citas)): ?>
                    <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?= $cita["idCita"]; ?></td>
                        <td><?= $cita["fecha"]; ?></td>
                        <td><?= $cita["hora"]; ?></td>
                        <td class="d-none d-md-table-cell"><?= $cita["numDocum"]; ?></td>
                        <td class="d-none d-md-table-cell"><?= $cita["nomCompleto"]; ?></td>
                        <td><?= $cita["estado"]; ?></td>
                        <td><?= $cita["nombreServi"]; ?>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No hay citas registradas.</td></tr>
                <?php endif; ?>
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
