<?php
if (!isset($_SESSION['rol'])) {
    header("Location: index.php?action=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Tipo de Documento</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Eliminar Tipo de Documento</h2>
<center>
    <div class="volver-form mb-4">
        <form action="index.php?action=openFormDeleteTipDocum" method="POST">
            <input type="hidden" name="action" value="openFormDeleteTipDocum">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label for="tipoDocumento" class="form-label mb-0" style="color:#d4af37; font-weight:600;">
                    Tipo de Documento:
                </label>
                <input type="text" name="tipoDocumento" id="tipoDocumento" required
                    placeholder="Escriba el tipo de documento aquí"
                    class="form-control w-auto"
                    style="background:#232323; color:#fff; border-color:#d4af37;">
                <button type="submit" class="btn-dashboard"
                    onclick="return confirm('¿Está seguro de eliminar este tipo de documento?')">
                    Eliminar
                </button>
            </div>
        </form>
    </div>
    </center>

    <?php if (!empty($tips)): ?>
        <div class="tabla-responsive mb-4">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>Tipo de Documento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tips as $tip): ?>
                    <tr>
                        <td><?= htmlspecialchars($tip['tipoDocumento'] ?? $tip['tipDocum'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="volver-form mt-2">
        <form action="index.php?action=dashboard" method="post">
            <button type="submit" name="action" value="dashboard" class="btn-dashboard">
                Dashboard
            </button>
        </form>
    </div>

</div>

</body>
</html>
