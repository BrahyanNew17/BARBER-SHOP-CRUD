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
    <title>Actualizar Barberos</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Barberos</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
            <strong>âœ“ Barbero actualizado correctamente.</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST" class="mb-4" style="background:transparent; border:none; box-shadow:none; max-width:100%; margin:0 0 1.5rem 0; padding:0; text-align:left;">
        <input type="hidden" name="action" value="searchBarberForUpdate">
        <div style="display:block;">
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Buscar por Nombre Completo:
            </label>
            <input type="text" name="nomCompleto" placeholder="Ingrese nombre" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:300px; max-width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard" style="margin-top:0;">Buscar Barbero</button>
        </div>
    </form>

    <?php if (isset($_POST['nomCompleto']) && empty($barbers)): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>âœ— No se encontrÃ³ ningÃºn barbero con ese nombre.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($barbers)): ?>
        <div style="display:block; width:100%; clear:both;">
        <?php foreach ($barbers as $barber): ?>
        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px; max-width:500px; display:block; clear:both;">
            <form action="index.php?action=actualizarBarbero" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="actualizarBarbero">
                <input type="hidden" name="idBarbero" value="<?= htmlspecialchars($barber['idBarbero']) ?>">

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Nombre Completo:</label>
                    <input type="text" name="nomCompleto" value="<?= htmlspecialchars($barber['nomCompleto']) ?>"
                        required class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">TelÃ©fono:</label>
                    <input type="text" name="telefono" value="<?= htmlspecialchars($barber['telefono']) ?>"
                        class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Correo:</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($barber['correo']) ?>"
                        class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-4">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Foto:</label>
                    <input type="file" name="foto" class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                    <?php if (!empty($barber['foto'])): ?>
                        <div class="mt-3 text-center">
                            <p style="color:#d4af37; font-size:0.85rem; margin-bottom:6px;">Foto actual:</p>
                            <img src="<?= $base ?>/photo/<?= htmlspecialchars($barber['foto']) ?>"
                                alt="Foto de <?= htmlspecialchars($barber['nomCompleto']) ?>"
                                style="max-width:150px; max-height:150px; border-radius:10px; object-fit:cover; border:2px solid #d4af37;">
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-dashboard w-100">Actualizar Barbero</button>
            </form>
        </div>
        <?php endforeach; ?>
        </div>

    <?php else: ?>
        <center>
        <div class="mb-4 p-3 d-flex align-items-center gap-3"
            style="background:#181818; border:1px solid #d4af37; border-radius:10px; max-width:500px; color:#d4af37;">
            <span style="font-weight:600;">Ingresa un nombre para buscar y editar un barbero.</span>
        </div>
        </center>
    <?php endif; ?>

    <form action="index.php?action=dashboard" method="post" class="mt-4" style="background:transparent; border:none; box-shadow:none; max-width:100%; margin:1.5rem 0 0 0; padding:0; text-align:left;">
        <button type="submit" name="action" value="dashboard" class="btn-dashboard" style="margin-top:0;">
            Dashboard
        </button>
    </form>

</div>

</body>
</html>

