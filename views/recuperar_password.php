<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar ContraseÃ±a</title>
  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="login-container">

    <div class="login-header">
        <div class="login-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="90">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>

        <h1>Recuperar ContraseÃ±a</h1>
        <p>Escribe tu correo electrÃ³nico y te enviaremos un enlace para restablecer tu contraseÃ±a.</p>
    </div>

    <div class="login-body">

        <?php
        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 'email_sent':
                    echo '<div class="alert alert-success">
                        âœ“ Se ha enviado un correo con las instrucciones para restablecer tu contraseÃ±a.
                        Revisa tu bandeja de entrada y la carpeta de spam.
                    </div>';
                    break;

                case 'check_email':
                    echo '<div class="alert alert-info">
                        Si el correo estÃ¡ registrado, recibirÃ¡s las instrucciones para restablecer tu contraseÃ±a.
                    </div>';
                    break;
            }
        }

        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'empty_email':
                    echo '<div class="alert alert-error">âœ— Por favor, ingresa tu correo electrÃ³nico.</div>';
                    break;
                case 'invalid_email':
                    echo '<div class="alert alert-error">âœ— Ingresa un correo electrÃ³nico vÃ¡lido.</div>';
                    break;
                case 'email_failed':
                    echo '<div class="alert alert-error">âœ— Error al enviar el correo. Intenta nuevamente.</div>';
                    break;
                case 'system_error':
                    echo '<div class="alert alert-error">âœ— Error del sistema. Intenta mÃ¡s tarde.</div>';
                    break;
                case 'token_invalid':
                    echo '<div class="alert alert-error">âœ— El enlace es invÃ¡lido o expirÃ³. Solicita uno nuevo.</div>';
                    break;
            }
        }

        if (isset($_GET['success']) && $_GET['success'] === 'password_changed') {
            echo '<div class="alert alert-success">
                âœ“ Tu contraseÃ±a fue cambiada exitosamente.
            </div>';
        }
        ?>

        <form method="POST" action="index.php?action=sendResetEmail" id="forgotForm">

            <div class="form-group">
                <label for="correo">Correo ElectrÃ³nico *</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    placeholder="ejemplo@correo.com"
                    required
                    autocomplete="email">
            </div>

            <button type="submit" class="login-btn">
                Enviar Enlace de RecuperaciÃ³n
            </button>
        </form>

        <div class="forgot-password">
            <a href="index.php?action=login">â† Volver al inicio de sesiÃ³n</a>
        </div>

        <div class="info-box">
            <p><strong>ðŸ“Œ Importante:</strong></p>
            <p>â€¢ El enlace expira en 1 hora.</p>
            <p>â€¢ Revisa spam si no lo encuentras.</p>
            <p>â€¢ Solo puedes solicitar uno activo por correo.</p>
            <p>â€¢ Si no tienes acceso a tu correo, contacta al administrador.</p>
        </div>

    </div>
</div>


    <script>
        var form       = document.getElementById('forgotForm');
        var emailInput = document.getElementById('correo');

        form.addEventListener('submit', function (e) {
            var email = emailInput.value.trim();

            if (email === '') {
                e.preventDefault();
                alert('Por favor, ingresa tu correo electrÃ³nico');
                return;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Por favor, ingresa un correo electrÃ³nico vÃ¡lido');
                return;
            }
        });

        emailInput.addEventListener('input', function () {
            this.value = this.value.toLowerCase();
        });
    </script>
</body>
</html>
