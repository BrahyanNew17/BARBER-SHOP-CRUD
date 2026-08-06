<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Detalle Venta Producto</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container" style="padding-top: 300px;">

    <h1 class="titulo mb-4">Insertar Detalle Venta Producto</h1>

    <?php if (isset($subTotal)): ?>
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div style="background:#1a1a1a; border:2px solid #d4af37; border-radius:10px; padding:15px; text-align:center;">
                    <p style="color:#d4af37; font-weight:bold; margin:0;">Subtotal calculado: $<?= number_format($subTotal, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=insertdetalleventproducto" method="POST">

                <label>Cantidad:</label>
                <input type="number" name="cantidad" min="1" required>

                <label>Precio Unitario:</label>
                <input type="number" name="precioUnitario" min="0" required>

                <label>Producto:</label>
                <select name="idProducto">
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['idProducto']; ?>"><?= $producto['nomProduc']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Venta Producto:</label>
                <select name="idVentaProducto" required>
                    <option value="" disabled selected>Seleccione una venta...</option>
                    <?php foreach ($ventasproductos as $v): ?>
                        <option value="<?= $v['idVentaProducto']; ?>">
                            Venta: <?= $v['idVentaProducto']; ?> - <?= $v['fecha']; ?> - <?= $v['hora']; ?> - <?= $v['numDocum']; ?> - ($<?= number_format($v['total'], 0, ',', '.'); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Guardar</button>
            </form>
        </div>
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
