<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Citas por Número de Documento</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Buscar Citas por Número de Documento</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=searchCitaByNumDocum" method="POST">
                <input type="hidden" name="action" value="searchCitaByNumDocum">
                <label>Número de Documento:</label>
                <input type="text" name="numDocum" required>
                <button type="submit">Buscar</button>
            </form>

            <form action="index.php" method="POST" style="margin-top:10px;">
                <input type="hidden" name="action" value="searchCitaByNumDocum">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
        </div>
    </div>

    <?php if (isset($cits) && count($cits) > 0): ?>
        <h2 class="titulo-secundario mb-3">Resultados de la búsqueda</h2>
        <div class="tabla-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th class="d-none d-md-table-cell">Nº Documento</th>
                        <th class="d-none d-md-table-cell">Barbero</th>
                        <th>Estado</th>
                        <th>Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cits as $cit): ?>
                    <tr>
                        <td><?= $cit['fecha'] ?></td>
                        <td><?= $cit['hora'] ?></td>
                        <td class="d-none d-md-table-cell"><?= $cit['numDocum'] ?></td>
                        <td class="d-none d-md-table-cell"><?= $cit['nomCompleto'] ?></td>
                        <td><?= $cit['estado'] ?></td>
                        <td><?= $cit['nombreServi'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif (isset($cits)): ?>
        <div style="background:#1a1a1a; border:2px solid #d4af37; border-radius:10px; padding:15px; text-align:center; margin-bottom:20px;">
            <p style="color:#d4af37; margin:0;">⚠️ No se encontraron citas con ese número de documento.</p>
        </div>
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
