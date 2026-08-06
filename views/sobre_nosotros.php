<?php if (!isset($base)) { $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); } ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros | Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
  </head>
<body>
  <?php include 'includes/header.php'; ?>


<section id="sobre-nosotros" class="sobre-nosotros">
<div class="container" style="padding-top: 50px;">
  <h2>SOBRE NOSOTROS</h2>

  <div class="sobre-container">

    <div class="sobre-card">
      <center><img src="<?= $base ?>/photo/barberia-interior.jpg" class="sobre-img" alt="Interior barberÃ­a"></center>

      <p>
        En <strong>Barbershop</strong> creemos que el estilo no tiene gÃ©nero.
        Creamos un espacio moderno, cÃ³modo y profesional donde cada cliente vive
        una experiencia de cuidado personal Ãºnica.
      </p>
    </div>

    <div class="sobre-card">
      <h3>Nuestro Equipo</h3>
      <p>
        Contamos con barberos y estilistas altamente capacitados,
        comprometidos con la excelencia y la atenciÃ³n personalizada.
        Nos actualizamos constantemente en tendencias y tÃ©cnicas modernas.
      </p>
    </div>

    <div class="sobre-card">
      <h3>Nuestros Servicios</h3>
      <ul class="lista-servicios">
        <li>âœ‚ Cortes clÃ¡sicos y modernos</li>
        <li>ðŸŽ¨ Estilismo y color</li>
        <li>ðŸ§” Perfilado de barba</li>
        <li>ðŸª’ Afeitado tradicional</li>
        <li>ðŸ§´ Tratamientos capilares y faciales</li>
      </ul>
    </div>

    <div class="sobre-card">
      <h3>Nuestra FilosofÃ­a</h3>
      <p>
        No se trata solo de un corte.
        Se trata de confianza, autenticidad y bienestar.
        Cada servicio estÃ¡ hecho con pasiÃ³n y dedicaciÃ³n.
      </p>
    </div>

    <div class="sobre-card text-center">
      <h3>Te Esperamos</h3>
      <p>
        ðŸ’ˆ <strong>Tu estilo empieza aquÃ­.</strong>
      </p>
    </div>

  </div>
</section>
<footer class="footer">
        <p class="footer-text">Â© 2026 <span>Barber ShopÂ®</span> â€” Todos los derechos reservados</p>
       <a href="/proyecto-barber-shop/docs/Manual_De_Usuario_Barberia.pdf" 
       class="footer-manual" 
       download>
       Descargar Manual de Usuario
    </a>
    </footer>

</body>
</html>

