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
    <title>Actualizar Venta Servicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

    <div class="container" style="padding-top: 150px;">

        <h2 class="titulo mb-4">Actualizar Venta Servicio</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
                <strong>✓ Venta actualizada correctamente.</strong>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="mb-4">
            <input type="hidden" name="action" value="searchVentaServicioByIdForUpdate">
            <div>
                <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                    Buscar por ID Venta Servicio:
                </label>
                <input type="text" name="idVentaServi" placeholder="Ingrese ID" required
                    style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
                <button type="submit" class="btn-dashboard">Buscar Venta</button>
            </div>
        </form>
        

        <?php if (isset($_POST['idVentaServi']) && empty($ventas)): ?>
            <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
                <strong>✗ No se encontró esa venta.</strong>
            </div>
        <?php endif; ?>

        <?php if (!empty($ventas)): ?>
            <?php foreach ($ventas as $venta): ?>
                <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px;">
                    <form action="index.php?action=actualizarVentaServicio" method="post">
                        <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">ID:</label>
                        <input type="number" name="idVentaServi" value="<?= htmlspecialchars($venta['idVentaServi']) ?>">

                        <div class="mb-3">
                            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Fecha:</label>
                            <input type="date" name="fecha" value="<?= htmlspecialchars($venta['fecha']) ?>" required
                                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                        </div>

                        <div class="mb-3">
                            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Hora:</label>
                            <input type="time" name="hora" value="<?= htmlspecialchars($venta['hora']) ?>" required
                                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                        </div>

                        <div class="mb-3">
                            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Total:</label>
                            <input type="number" name="total" value="<?= htmlspecialchars(number_format((float)$venta['total'], 2, '.', '')) ?>"
                                step="0.01" required
                                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                        </div>

                        <div class="mb-3">
                            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Cliente:</label>
                            <input type="text" value="<?= htmlspecialchars($venta['nombreComplet']) ?>" readonly
                                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                            <input type="hidden" name="numDocum" value="<?= htmlspecialchars($venta['numDocum']) ?>">
                        </div>

                        <button type="submit" class="btn-save">Actualizar Venta</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="mb-4 p-3 d-flex align-items-center gap-3"
                style="background:#181818; border:1px solid #d4af37; border-radius:10px; color:#d4af37;">
                <span style="font-weight:600;">Ingresa un ID para buscar y editar una venta de servicio.</span>
            </div>
        <?php endif; ?>

        
        <form action="index.php?action=dashboard" method="post">
            <button type="submit" name="action" value="dashboard" class="btn-dashboard">Dashboard</button>
        </form>

    </div>

    <?php if (!empty($todasVentas)): ?>
        <div class="container py-4">
            <h5 style="color:#d4af37; font-weight:600; margin-bottom:12px;">Lista de Ventas de Servicio</h5>
            <div class="tabla-responsive">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th class="d-none d-md-table-cell">Hora</th>
                            <th>Cliente</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($todasVentas as $tv): ?>
                            <tr>
                                <td style="color:#d4af37; font-weight:600;"><?= htmlspecialchars($tv['idVentaServi']) ?></td>
                                <td><?= htmlspecialchars($tv['fecha']) ?></td>
                                <td class="d-none d-md-table-cell"><?= htmlspecialchars($tv['hora']) ?></td>
                                <td><?= htmlspecialchars($tv['nombreComplet'] ?? '') ?></td>
                                <td><?= htmlspecialchars($tv['total']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>
