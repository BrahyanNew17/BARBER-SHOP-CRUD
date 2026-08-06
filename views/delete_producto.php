<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/styles.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 100px;">

    <h1 class="titulo mb-4">Eliminar Producto</h1>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form class="form-eliminar" action="index.php?action=openFormDeleteProducto" method="POST">
                <input type="hidden" name="action" value="openFormDeleteProducto">
                <label>Nombre Producto:</label>
                <input type="text" name="nomProduc" required>
                <button type="submit" onclick="return confirm('¿Está seguro de eliminar este producto?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <h2 class="titulo-secundario mb-3">Lista de Productos</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Producto</th>
                    <th class="d-none d-md-table-cell">Precio Unitario</th>
                    <th class="d-none d-md-table-cell">Cantidad</th>
                    <th class="d-none d-lg-table-cell">Marca</th>
                    <th class="d-none d-lg-table-cell">Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto["idProducto"]); ?></td>
                    <td><?= htmlspecialchars($producto["nomProduc"]); ?></td>
                    <td class="d-none d-md-table-cell">$<?= number_format($producto["precioUni"], 0, ',', '.'); ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($producto["cantidad"]); ?></td>
                    <td class="d-none d-lg-table-cell"><?= htmlspecialchars($producto["marca"]); ?></td>
                    <td class="d-none d-lg-table-cell"><?= htmlspecialchars($producto["categoria"]); ?></td>
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