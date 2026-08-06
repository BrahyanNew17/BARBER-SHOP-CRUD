<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Producto por Nombre</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4">

    <h2 class="titulo mb-4">Buscar Producto por Nombre</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=searchProductoByProducto" method="POST">
                <label>Producto:</label>
                <input type="text" name="nomProduc" required>
                <button type="submit">Buscar</button>
            </form>

            <form action="index.php" method="POST" style="margin-top:10px;">
                <input type="hidden" name="action" value="searchProductoByProducto">
                <button type="submit" class="btn-dashboard w-100">Volver a buscar</button>
            </form>
        </div>
    </div>

    <?php
    if (!isset($buscando)) $buscando = false;
    if (!isset($producs) || !is_array($producs)) $producs = [];
    if (!isset($productos) || !is_array($productos)) $productos = [];
    ?>

    <?php if ($buscando === false): ?>

        <h2 class="titulo-secundario mb-3">Consulta de Productos</h2>
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
                    <?php foreach ($productos as $p): ?>
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

    <?php else: ?>

        <h2 class="titulo-secundario mb-3">Resultado de la búsqueda</h2>

        <?php if (count($producs) > 0): ?>
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
                                <img src="/proyecto-barber-shop/photo/<?= htmlspecialchars($p['foto']); ?>"
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
        <?php else: ?>
            <div style="background:#1a1a1a; border:2px solid #d4af37; border-radius:10px; padding:15px; text-align:center; margin-bottom:20px;">
                <p style="color:#d4af37; margin:0;">⚠️ No se encontraron productos con ese nombre.</p>
            </div>
        <?php endif; ?>

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
