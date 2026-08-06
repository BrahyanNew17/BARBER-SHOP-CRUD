<?php
require_once(__DIR__ . "/../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT * FROM servicio ORDER BY idServicio ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (!isset($base)) { $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios | Barber Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">

  
</head>

<body>

<?php include 'includes/header.php'; ?>
<div class="container" style="padding-top: 100px;">
    <section class="introduccion">
        <h5>En nuestra barbería combinamos estilo, precisión y cuidado personal para ofrecerte una experiencia completa.
            Desde cortes clásicos hasta tratamientos especializados, cada servicio está pensado para resaltar tu mejor versión.</h5>
    </section>

<div class="container mt-4">

    <h1 class="titulo-productos">Nuestros Servicios</h1>

<div class="row mb-4">
    <?php foreach ($servicios as $s): ?>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            <div class="product-card">
                <div class="product-image">
                    <img src="<?= $base ?>/photo/<?= htmlspecialchars($s['foto'] ?? 'default-servicio.jpg') ?>" 
                         alt="<?= htmlspecialchars($s['nombreServi']) ?>">
                </div>
                <h5><?= htmlspecialchars($s['nombreServi']) ?></h5>
                <p style="color:#ddd; font-size:0.95rem;">
                    ⏱️ Duración: <?= htmlspecialchars($s['duracion']) ?>
                </p>
                <p style="color:#d4af37; font-weight:bold; font-size:1.1rem;">
                    $<?= number_format($s['precioUni'], 0, ',', '.') ?>
                </p>
                <a href="<?= isset($_SESSION['user']) ? 'index.php?action=insertCita' : 'index.php?action=login&msg=cita' ?>" 
                   class="btn btn-gold">Reservar</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
<footer class="footer">
        <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
         <a href="/proyecto-barber-shop/docs/Manual_De_Usuario_Barberia.pdf" 
       class="footer-manual" 
       download>
       Descargar Manual de Usuario
    </a>
    </footer>
</body>
</html>
