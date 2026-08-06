<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Estado</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 300px;">

    <h1 class="titulo mb-4">Eliminar Estado</h1>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form class="form-eliminar" action="index.php?action=openFormDeleteEstado" method="POST">
                <input type="hidden" name="action" value="openFormDeleteEstado">
                <label>Nombre Estado:</label>
                <input type="text" name="estado" id="estado" required>
                <button type="submit" onclick="return confirm('¿Está seguro de eliminar este estado?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <h2 class="titulo-secundario mb-3">Lista de Estados</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>ID Estado</th>
                    <th>Nombre Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estados as $estado): ?>
                <tr>
                    <td><?= $estado["idEstado"]; ?></td>
                    <td><?= $estado["estado"]; ?></td>
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
