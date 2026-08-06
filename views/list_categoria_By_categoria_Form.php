<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Categoría por Nombre</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h2 class="titulo mb-4">Buscar Categoría por Nombre</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=searchcategorByName" method="POST">
                <input type="hidden" name="action" value="searchcategorByName">
                <label>Categoría:</label>
                <input type="text" name="categoria" required>
                <button type="submit">Buscar</button>
            </form>

            <form action="index.php?action=searchcategorByName" method="POST" style="margin-top:10px;">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
        </div>
    </div>

    <?php if (isset($categors) && count($categors) > 0): ?>
        <div class="tabla-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>ID Categoría</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categors as $categor): ?>
                    <tr>
                        <td><?= htmlspecialchars($categor["idCategoria"]) ?></td>
                        <td><?= htmlspecialchars($categor["categoria"]) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif (isset($categors)): ?>
        <div style="background:#1a1a1a; border:2px solid #d4af37; border-radius:10px; padding:15px; text-align:center; margin-bottom:20px;">
            <p style="color:#d4af37; margin:0;">⚠️ No se encontraron categorías con ese nombre.</p>
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
