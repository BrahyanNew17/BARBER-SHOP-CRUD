<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4">

    <h2 class="titulo mb-4">Consulta de Productos</h2>

    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th class="d-none d-md-table-cell">Descripción</th>
                    <th>Foto</th>
                    <th>Precio</th>
                    <th class="d-none d-md-table-cell">Cantidad</th>
                    <th class="d-none d-lg-table-cell">Marca</th>
                    <th class="d-none d-lg-table-cell">Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producs as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['idProducto']) ?></td>
                    <td><?= htmlspecialchars($p['nomProduc']) ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($p['descripcion']) ?></td>
                    <td>
                        <img src="<?= $base ?>/photo/<?= htmlspecialchars($p['foto']); ?>"
                             style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:2px solid #d4af37;">
                    </td>
                    <td>$<?= number_format($p['precioUni'], 0, ',', '.') ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($p['cantidad']) ?></td>
                    <td class="d-none d-lg-table-cell"><?= htmlspecialchars($p['marca']) ?></td>
                    <td class="d-none d-lg-table-cell"><?= htmlspecialchars($p['categoria']) ?></td>
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
