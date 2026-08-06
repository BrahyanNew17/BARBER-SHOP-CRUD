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
    <title>Actualizar Citas</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Citas</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'cancelada'): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>✓ Cita cancelada y horario liberado correctamente.</strong>
        </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="mb-4 p-3" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px;">
            <strong>✓ Cita actualizada correctamente.</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="searchCitaByNumDocumUpdate">
        <div>
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Buscar por Número de Documento:
            </label>
            <input type="text" name="numDocum" placeholder="Ingrese documento" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard">Buscar Cita</button>
        </div>
    </form>

    <?php if (isset($_POST['numDocum']) && empty($citas)): ?>
        <div class="mb-4 p-3" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px;">
            <strong>✗ No se encontró ninguna cita con ese documento.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($citas)): ?>
        <?php foreach ($citas as $cita): ?>

        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px;">
            <form action="index.php?action=actualizarCita" method="post">
                <input type="hidden" name="action" value="actualizarCita">
                <input type="hidden" name="idCita" value="<?= htmlspecialchars($cita['idCita']) ?>">

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Fecha:</label>
                    <input type="date" name="fecha" value="<?= htmlspecialchars($cita['fecha']) ?>"
                        required
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Hora:</label>
                    <input type="time" name="hora" value="<?= htmlspecialchars($cita['hora']) ?>"
                        required
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Número de Documento:</label>
                    <input type="text" name="numDocum" value="<?= htmlspecialchars($cita['numDocum']) ?>"
                        readonly
                        style="background:#2a2a2a; color:#aaa; border:1px solid #555; border-radius:7px; padding:8px 10px; width:100%;">
                </div>

                <div class="mb-3">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Barbero:</label>
                    <input type="text" value="<?= htmlspecialchars($cita['nomCompleto']) ?>"
                        readonly
                        style="background:#2a2a2a; color:#aaa; border:1px solid #555; border-radius:7px; padding:8px 10px; width:100%;">
                    <input type="hidden" name="idBarbero" value="<?= htmlspecialchars($cita['idBarbero']) ?>">
                </div>

                <div class="mb-4">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Estado:</label>
                    <select name="idEstado"
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                        <option value="1" <?= $cita['idEstado']==1 ? 'selected' : '' ?>>Programada</option>
                        <option value="2" <?= $cita['idEstado']==2 ? 'selected' : '' ?>>En Servicio</option>
                        <option value="3" <?= $cita['idEstado']==3 ? 'selected' : '' ?>>Completada</option>
                        <option value="4" <?= $cita['idEstado']==4 ? 'selected' : '' ?>>Cancelada por Barbería</option>
                        <option value="5" <?= $cita['idEstado']==5 ? 'selected' : '' ?>>Cancelada por Usuario</option>
                        <option value="6" <?= $cita['idEstado']==6 ? 'selected' : '' ?>>No Asistió</option>
                    </select>
                </div>

                 <div class="mb-4">
                    <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">Servicio:</label>
                    <select name="idServicio"
                        style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%;">
                        <option value="1" <?= $cita['idServicio']==1 ? 'selected' : '' ?>>Corte</option>
                        <option value="2" <?= $cita['idServicio']==2 ? 'selected' : '' ?>>Cejas</option>
                        <option value="3" <?= $cita['idServicio']==3 ? 'selected' : '' ?>>Barba</option>
                        <option value="4" <?= $cita['idServicio']==4 ? 'selected' : '' ?>>Corte + Barba</option>
                        <option value="5" <?= $cita['idServicio']==5 ? 'selected' : '' ?>>Corte + Cejas</option>
                        <option value="6" <?= $cita['idServicio']==6 ? 'selected' : '' ?>>Corte + Barba + Cejas</option>
                    </select>
                </div>

            
                <button type="submit" class="btn-dashboard w-100">Actualizar Cita</button>
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
