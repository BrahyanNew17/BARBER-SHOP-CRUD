<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes de Contacto</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Mensajes de Contacto</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="d-none d-md-table-cell">Correo</th>
                    <th class="d-none d-md-table-cell">Teléfono</th>
                    <th>Mensaje</th>
                    <th class="d-none d-md-table-cell">Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c["nombre"]) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["correo"]) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["telefono"]) ?></td>
                    <td><?= nl2br(htmlspecialchars($c["mensaje"])) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["fecha"]) ?></td>
                    <td>
                        <form action="index.php?action=eliminarMensaje" method="post" onsubmit="return confirm('¿Borrar este mensaje?');">
                            <input type="hidden" name="idContacto" value="<?= $c['idContacto'] ?>">
                            <button type="submit" class="btn-dashboard">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($contactos)): ?>
                <tr><td colspan="6">No hay mensajes todavía.</td></tr>
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
