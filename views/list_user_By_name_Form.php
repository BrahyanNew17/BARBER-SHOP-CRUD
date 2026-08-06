<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cliente por Nombre</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Buscar Cliente por Nombre</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=searchUserByName" method="POST">
                <input type="hidden" name="action" value="searchUserByName">
                <label>Nombre:</label>
                <input type="text" name="name" required>
                <button type="submit">Buscar</button>
            </form>
            <form action="index.php?action=searchUserByName" method="POST" style="margin-top:10px;">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
        </div>
    </div>

    <?php if (isset($users) && count($users) > 0): ?>
        <div class="tabla-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>Nº Documento</th>
                        <th>Nombre</th>
                        <th class="d-none d-md-table-cell">Teléfono</th>
                        <th class="d-none d-lg-table-cell">Dirección</th>
                        <th class="d-none d-md-table-cell">Correo</th>
                        <th class="d-none d-lg-table-cell">Tipo Documento</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['numDocum']) ?></td>
                        <td><?= htmlspecialchars($user['nombreComplet']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($user['Telefono']) ?></td>
                        <td class="d-none d-lg-table-cell"><?= htmlspecialchars($user['direccion']) ?></td>
                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($user['correo']) ?></td>
                        <td class="d-none d-lg-table-cell"><?= htmlspecialchars($user['tipodocumento']) ?></td>
                        <td><?= htmlspecialchars($user['rol']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif (isset($users)): ?>
        <div style="background:#1a1a1a; border:2px solid #d4af37; border-radius:10px; padding:15px; text-align:center; margin-bottom:20px;">
            <p style="color:#d4af37; margin:0;">⚠️ No se encontraron clientes con ese nombre.</p>
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
