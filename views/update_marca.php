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
    <title>Actualizar Marcas</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Marcas</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
            <strong>✓ Marca actualizada correctamente.</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="searchMarcaByName">
        <div>
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Buscar por Marca:
            </label>
            <input type="text" name="marca" placeholder="Ingrese marca" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard">Buscar Marca</button>
        </div>
    </form>

    <?php if (isset($_POST['marca']) && empty($marcas)): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>✗ No se encontró esa marca.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($marcas)): ?>
        <?php foreach ($marcas as $marca): ?>
        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px;">
            <form action="index.php?action=actualizarMarca" method="post">
                <input type="hidden" name="action" value="actualizarMarca">
                <input type="hidden" name="idMarca" value="<?= htmlspecialchars($marca['idMarca']) ?>">

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Marca:</label>
                    <input type="text" name="marca" value="<?= htmlspecialchars($marca['marca']) ?>"
                        required
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <button type="submit" class="btn-dashboard w-100">Actualizar Marca</button>
            </form>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
        <center>
        <div class="mb-4 p-3 d-flex align-items-center gap-3"
            style="background:#181818; border:1px solid #d4af37; border-radius:10px; max-width:500px; color:#d4af37;">
            <span style="font-weight:600;">Ingresa una marca para buscarla y editarla.</span>
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
