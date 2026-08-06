<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Barbero</title>
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page">

<div class="container" style="padding-top: 450px;">

    <h1 class="titulo mb-4">Eliminar Barbero</h1>

    <!-- Formulario centrado y responsivo -->
    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form class="form-eliminar" action="index.php?action=openFormDeleteBarbero" method="POST">
                <input type="hidden" name="action" value="openFormDeleteBarbero">
                <label>Nombre Completo:</label>
                <input type="text" name="nomCompleto" required>
                <button type="submit" onclick="return confirm('Â¿EstÃ¡ seguro de eliminar este barbero?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <h2 class="titulo-secundario mb-3">Lista de Barberos</h2>

    <!-- Tabla responsiva -->
    <div class="tabla-responsive">
        <table class="w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class="d-none d-md-table-cell">TelÃ©fono</th>
                    <th class="d-none d-md-table-cell">Correo</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barbers as $barber): ?>
                <tr>
                    <td><?= $barber["idBarbero"]; ?></td>
                    <td><?= $barber["nomCompleto"]; ?></td>
                    <td class="d-none d-md-table-cell"><?= $barber["telefono"]; ?></td>
                    <td class="d-none d-md-table-cell"><?= $barber["correo"]; ?></td>
                    <td>
                        <img src="<?= $base ?>/photo/<?= $barber['foto']; ?>" 
                             style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:2px solid #d4af37;">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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

