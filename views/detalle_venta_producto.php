<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Venta de Producto</title>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body>
    <form>
    <section class="detalleVentaProducto" id="detalleVentaProducto">
        <h2>Detalle Venta de Producto</h2>
        <label for="idDetalle">ID Detalle:</label>
        <input type="number" id="idDetalle" name="idDetalle" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br>

        <label for="precioUnitario">Precio Unitario:</label>
        <input type="number" id="precioUnitario" name="precioUnitario" required><br>

        <label for="subtotal">Subtotal:</label>
        <input type="number" id="subtotal" name="subtotal" required><br>

        <label for="idProducto">ID Producto:</label>
        <input type="number" id="idProducto" name="idProducto" required><br>

        <label for="idVentaProducto">ID Venta Producto:</label>
        <input type="number" id="idVentaProducto" name="idVentaProducto" required><br>

        <button type="submit">Registrar Detalle</button>
    </section>
</form>
</body>
</html>
