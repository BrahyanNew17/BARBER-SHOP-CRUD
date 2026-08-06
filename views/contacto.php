<?php if (!isset($base)) { $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); } ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contacto | Barber Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>

<body>
<?php include 'includes/header.php'; ?>


    <main class="container mt-5">

        <section class="text-center mb-4">
            <h2 class="fw-bold">CONTÁCTANOS</h2>
            <p>
                ¿Tienes alguna pregunta o deseas agendar una cita?<br>
                Escríbenos y con gusto te atenderemos.
            </p>
        </section>
<br>
        <section class="row g-4">

            <div class="col-md-6">
                <div class="bloque p-4 h-100">
                    <h3 class="mb-3">Envíanos un Mensaje</h3>

                    <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
                        <div class="alert alert-success">✅ ¡Mensaje enviado! Pronto nos pondremos en contacto.</div>
                    <?php endif; ?>
                    <?php if (isset($_GET['error'])): ?>
                        <?php $errs = [
                            'campos_vacios'  => '❌ Por favor completa nombre, correo y mensaje.',
                            'correo_invalido'=> '❌ El correo electrónico no es válido.',
                            'sistema'        => '❌ Error del sistema. Intenta de nuevo.',
                        ]; ?>
                        <div class="alert alert-danger"><?= $errs[$_GET['error']] ?? '❌ Error desconocido.' ?></div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=enviarContacto">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" id="correo" name="correo" class="form-control" placeholder="correo@ejemplo.com" value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="number" type="tel" id="telefono" name="telefono" class="form-control" placeholder="Tu número" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" class="form-control" rows="4" placeholder="Escribe tu mensaje aquí" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            ENVIAR MENSAJE
                        </button>
                    </form>
                </div>
            </div>


            <div class="col-md-6">
                <div class="bloque p-4 h-100">
                    <h3 class="mb-3">Información de contacto</h3>

                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>📍 Dirección:</strong> Ibague Tolima</li>
                        <li class="mb-2"><strong>📞 Teléfono:</strong> +57 3202166561</li>
                        <li class="mb-2"><strong>📧 Correo Electrónico:</strong> proyectobarbershop17@gmail.com</li>
                        <li class="mb-2"><strong>🕒 Horario De Atencion:</strong> Lun - Sáb | 9:00 AM - 8:00 PM</li>
                    </ul>
                </div>
            </div>

        </section>

    </main>


    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div id="mensajeToast" class="toast align-items-center border-3" role="alert" aria-live="assertive"
            aria-atomic="true" style="background-color: rgba(0,0,0,0.95);
                color: white;
                border: 2px solid gold;
                border-radius: 12px;
                box-shadow: 0 0 20px gold;
                min-width: 280px;
                transform: translateX(120%);
                transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
                margin-top: 60px;">
            <div class="d-flex">
                <div class="toast-body">
                    ¡Mensaje enviado correctamente! Pronto nos pondremos en contacto.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        </script>
<footer class="footer">
        <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
        <a href="/docs/Manual_De_Usuario_Barberia.pdf" 
       class="footer-manual" 
       download>
       Descargar Manual de Usuario
    </a>
    </footer>
</body>

</html>
