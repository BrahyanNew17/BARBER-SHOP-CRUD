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
    <title>Actualizar Servicios</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Servicios</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
            <strong>âœ“ Servicio actualizado correctamente.</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="searchServicioForUpdate">
        <div>
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Buscar por Nombre:
            </label>
            <input type="text" name="nombreServi" placeholder="Ingrese nombre" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard">Buscar Servicio</button>
        </div>
    </form>

    <?php if (isset($_POST['nombreServi']) && empty($servicios)): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>âœ— No se encontrÃ³ ese servicio.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($servicios)): ?>
        <?php foreach ($servicios as $servicio): ?>
        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px;">
            <form action="index.php?action=actualizarServicio" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="actualizarServicio">
                <input type="hidden" name="idServicio" value="<?= htmlspecialchars($servicio['idServicio']) ?>">

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Nombre Servicio:</label>
                    <input type="text" name="nombreServi" value="<?= htmlspecialchars($servicio['nombreServi']) ?>"
                        required
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Precio Unitario:</label>
                    <input type="number" name="precioUni" value="<?= htmlspecialchars($servicio['precioUni']) ?>"
                        step="0.01" required
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">DuraciÃ³n:</label>
                    <input type="text" name="duracion" value="<?= htmlspecialchars($servicio['duracion']) ?>"
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-4">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Foto (dejar vacÃ­o para mantener la actual):</label>
                    <?php if (!empty($servicio['foto'])): ?>
                        <div class="mb-2">
                            <img src="<?= $base ?>/photo/<?= htmlspecialchars($servicio['foto']) ?>" alt="Foto actual"
                                style="max-width:120px; max-height:120px; border-radius:8px; border:2px solid #d4af37; object-fit:cover;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="foto" accept="image/*"
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <button type="submit" class="btn-dashboard w-100">Actualizar Servicio</button>
            </form>
        </div>
        <?php endforeach; ?>

    <?php endif; ?>

    <form action="index.php?action=dashboard" method="post" class="mt-4">
        <button type="submit" name="action" value="dashboard" class="btn-dashboard">
            Dashboard
        </button>
    </form>

</div>

</body>
</html>

