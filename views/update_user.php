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
    <title>Actualización de Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<div class="container py-4" style="max-width:600px; margin:0 auto;">

    <h2 class="titulo mb-4">Actualizar Usuarios</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert mb-4" style="background:#1a3a1a; color:#4caf50; border:1px solid #4caf50; border-radius:8px; padding:12px 16px;">
            <strong>✓ Usuario actualizado correctamente.</strong>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['rol'] === 'cliente'): ?>
    
    <form action="index.php" method="POST" class="mb-4" id="autoSearch">
        <input type="hidden" name="action" value="searchUserByNumDocum">
        <input type="hidden" name="numDocum" value="<?= htmlspecialchars($_SESSION['numDocum']) ?>">
    </form>
    <?php if (empty($users) && !isset($_GET['success'])): ?>
    <script>document.getElementById('autoSearch').submit();</script>
    <?php endif; ?>
    <?php else: ?>
    <form action="index.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="searchUserByNumDocum">
        <div>
            <label style="color:#d4af37; font-weight:600; display:block; margin-bottom:6px;">
                Número de Documento:
            </label>
            <input type="text" name="numDocum" id="numDocumSearch"
                placeholder="Ingrese documento" required
                style="background:#232323; color:#fff; border:1px solid #d4af37; border-radius:7px; padding:8px 10px; width:100%; display:block; margin-bottom:10px;">
            <button type="submit" class="btn-dashboard">Buscar Usuario</button>
        </div>
    </form>
    <?php endif; ?>

    <?php if (isset($_POST['numDocum']) && empty($users)): ?>
        <div class="mb-4" style="background:#3a1a1a; color:#f44336; border:1px solid #f44336; border-radius:8px; padding:12px 16px;">
            <strong>✗ No se encontró ningún usuario con ese documento.</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
        <div class="mb-4 p-4" style="background:#181818; border:1px solid #d4af37; border-radius:12px; max-width:500px;">
            <form action="index.php?action=actualizar" method="post">
                <input type="hidden" name="action" value="actualizar">

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Número de Documento:</label>
                    <input type="text" name="numDocum" value="<?= htmlspecialchars($user['numDocum']) ?>"
                        readonly class="form-control"
                        style="background:#2a2a2a; color:#aaa; border-color:#555;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Nombre Completo:</label>
                    <input type="text" name="nombreComplet" value="<?= htmlspecialchars($user['nombreComplet']) ?>"
                        required class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Teléfono:</label>
                    <input type="text" name="Telefono" value="<?= htmlspecialchars($user['Telefono']) ?>"
                        class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Dirección:</label>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($user['direccion']) ?>"
                        class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Correo:</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($user['correo']) ?>"
                        class="form-control"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Tipo Documento:</label>
                    <select name="idtipoDoc" class="form-select"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                        <?php foreach ($docums as $docum): ?>
                            <option value="<?= htmlspecialchars($docum['idtipoDoc']) ?>"
                                <?= ($docum['idtipoDoc'] == $user['idtipoDoc']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($docum['tipoDocumento']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if ($_SESSION['rol'] === 'admin'): ?>
                <div class="mb-4">
                    <label class="form-label" style="color:#d4af37; font-weight:600;">Rol:</label>
                    <select name="idRol" required class="form-select"
                        style="background:#232323; color:#fff; border-color:#d4af37;">
                        <option value="1" <?= ($user['idRol'] ?? '') == 1 ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= ($user['idRol'] ?? '') == 2 ? 'selected' : '' ?>>Barbero</option>
                        <option value="3" <?= ($user['idRol'] ?? '') == 3 ? 'selected' : '' ?>>Cliente</option>
                    </select>
                </div>
                <?php else: ?>
                    
                    <input type="hidden" name="idRol" value="<?= htmlspecialchars($user['idRol']) ?>">
                <?php endif; ?>

                <button type="submit" class="btn-dashboard w-100">Guardar Cambios</button>
            </form>
        </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="mb-4 p-3 d-flex align-items-center gap-3"
            style="background:#181818; border:1px solid #d4af37; border-radius:10px; max-width:500px; color:#d4af37;">

            <span style="font-weight:600;">Ingresa un número de documento para buscar y editar un usuario.</span>
        </div>
    <?php endif; ?>

    <form action="index.php?action=dashboard" method="post" class="mt-4">
        <button type="submit" name="action" value="dashboard" class="btn-dashboard">
            Dashboard
        </button>
    </form>

</div>

</body>
</html>
