<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<?php include 'includes/header.php'; ?>
<body class="crud-page" style="background:#000; color:#fff;">

<?php
$erroresCita = [
    'ocupado'          => '❌ Ese barbero ya tiene una cita en esa fecha y hora. Elige otro horario.',
    'fecha_pasada'     => '❌ No puedes agendar una cita en una fecha que ya pasó.',
    'cliente_no_existe'=> '❌ El número de documento no está registrado como cliente.',
];
if (isset($_GET['error']) && isset($erroresCita[$_GET['error']])): ?>
    <div class="alert alert-danger mx-3 mt-3"><?= $erroresCita[$_GET['error']] ?></div>
<?php endif; ?>
<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <div class="alert alert-success mx-3 mt-3">✅ ¡Cita registrada exitosamente!</div>
<?php endif; ?>

<div class="container" style="padding-top: 300px;">
    <h1 class="titulo mb-4">Agendar Cita</h1>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form class="form-eliminar" action="index.php?action=insertCita" method="POST">

                <label>Fecha:</label>
                <input type="date" name="fecha" required min="<?php echo date('Y-m-d'); ?>">

                <label>Hora:</label>
                <input type="time" name="hora" required min="08:00" max="18:00">

                <label>Número de Documento:</label>
                <input type="text" name="numDocum"
                       value="<?php echo htmlspecialchars($_SESSION['numDocum'] ?? ''); ?>"
                       <?php echo isset($_SESSION['numDocum']) ? 'readonly style="opacity:0.7;cursor:not-allowed;"' : 'required'; ?>>

                <label>Servicio:</label>
                <select name="idServicio" required>
                    <option value="" disabled selected>Selecciona un servicio</option>
                    <?php foreach ($servicios as $s): ?>
                        <option value="<?php echo $s['idServicio']; ?>">
                            <?php echo htmlspecialchars($s['nombreServi']); ?> —
                            $<?php echo number_format($s['precioUni'], 0, ',', '.'); ?>
                            (<?php echo htmlspecialchars($s['duracion']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Barbero:</label>
                <select name="idBarbero" required>
                    <option value="" disabled selected>Selecciona un barbero</option>
                    <?php foreach ($barberos as $b): ?>
                        <option value="<?php echo $b['idBarbero']; ?>"><?php echo htmlspecialchars($b['nomCompleto']); ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Guardar Cita</button>
            </form>
        </div>
    </div>

    <div class="volver-form mt-4">
        <form action="index.php?action=dashboard" method="post">
            <button type="submit" name="action" value="dashboard" class="btn-dashboard">Dashboard</button>
        </form>
    </div>
</div>

</body>
</html>
