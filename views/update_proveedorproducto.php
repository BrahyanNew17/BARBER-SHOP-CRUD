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
    <title>Actualizar Proveedor Producto</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Proveedor Producto</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
            <strong>✓ Proveedor Producto actualizado correctamente.</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="searchProveedorProductoByIdForUpdate">
        <div>
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Buscar por ID:
            </label>
            <input type="text" name="idProveProduc" placeholder="Ingrese ID" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard">Buscar</button>
        </div>
    </form>

    <?php if (isset($_POST['idProveProduc']) && empty($proveedorProductos)): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>✗ No se encontró ese proveedor producto.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($proveedorProductos)): ?>
        <?php foreach ($proveedorProductos as $pp): ?>
        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px;">
            <form action="index.php?action=actualizarProveedorProducto" method="post">
                <input type="hidden" name="action" value="actualizarProveedorProducto">
                <input type="hidden" name="idProveProduc" value="<?= htmlspecialchars($pp['idProveProduc']) ?>">

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Proveedor:</label>
                    <input type="text" value="<?= htmlspecialchars($pp['nombreProveedor']) ?>"
                        
                        style="background:#2a2a2a; color:#aaa; border:1px solid #555; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-4">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Producto:</label>
                    <input type="text" value="<?= htmlspecialchars($pp['nomProduc']) ?>"
                        
                        style="background:#2a2a2a; color:#aaa; border:1px solid #555; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <button type="submit" class="btn-dashboard w-100">Actualizar Asignación</button>
            </form>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
        <center>
        <div class="mb-4 p-3 d-flex align-items-center gap-3"
            style="background:#181818; border:1px solid #d4af37; border-radius:10px; max-width:500px; color:#d4af37;">
            <span style="font-weight:600;">Ingresa un ID para buscar y editar un proveedor producto.</span>
        </div>
        </center>
    <?php endif; ?>

    <form action="index.php?action=dashboard" method="post" class="mt-4">
        <button type="submit" name="action" value="dashboard" class="btn-dashboard">
            Dashboard
        </button>
    </form>

</div>

</body>
</html>
