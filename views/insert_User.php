<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<body class="crud-page" style="background:#000; color:#fff;">
    
<?php include 'includes/header.php'; ?>
<div class="container" style="padding-top: 560px;">

    <h1 class="titulo mb-4">Insertar Cliente</h1>

    <?php
    $errorMessages = [
        'empty_fields'    => '❌ Por favor completa todos los campos obligatorios.',
        'document_exists' => '❌ Ya existe un usuario con ese número de documento.',
        'email_exists'    => '❌ Ya existe un usuario con ese correo electrónico.',
        'system_error'    => '❌ Error del sistema. Intenta de nuevo.',
    ];
    if (isset($_GET['error']) && isset($errorMessages[$_GET['error']])): ?>
        <div class="alert alert-danger"><?= $errorMessages[$_GET['error']] ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
        <div class="alert alert-success">✅ Cliente insertado exitosamente.</div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=insertUser" method="POST">

                <label>Número de Documento:</label>
                <input type="text" name="numDocum" required>

                <label>Nombre Completo:</label>
                <input type="text" name="nombreComplet" required>

                <label>Teléfono:</label>
                <input type="number" name="Telefono" required>

                <label>Dirección:</label>
                <input type="text" name="direccion" required>

                <label>Correo:</label>
                <input type="email" name="correo" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <label>Tipo de Documento:</label>
                <select name="idtipoDoc">
                    <?php foreach ($docums as $docum): ?>
                        <option value="<?= $docum['idtipoDoc']; ?>"><?= $docum['tipoDocumento']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Rol:</label>
                <select name="idRol" required>
                    <option value="1">Admin</option>
                    <option value="2">Barbero</option>
                    <option value="3">Cliente</option>
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
