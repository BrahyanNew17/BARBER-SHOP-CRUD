<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberos</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Barberos</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th class="d-none d-md-table-cell">TelÃ©fono</th>
                    <th class="d-none d-md-table-cell">Correo</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barbers as $barber): ?>
                <tr>
                    <td><?= htmlspecialchars($barber["nomCompleto"]) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($barber["telefono"]) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($barber["correo"]) ?></td>
                    <td>
                        <img src="<?= $base ?>/photo/<?= htmlspecialchars($barber['foto']) ?>"
                             style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:2px solid #d4af37;">
                    </td>
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

