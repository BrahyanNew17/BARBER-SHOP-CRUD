<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $rol = $_SESSION['rol'] ?? '';
    header("Location: index.php?action=" . ($rol === 'cliente' ? 'principal' : 'dashboard'));
    exit();
}

$client_id = "868363331625-dh5i8j3372qhn47knpcq1mqfqjim4o0t.apps.googleusercontent.com";


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];

$base_path = '';
$redirect_uri = $protocol . '://' . $host . $base_path . '/index.php?action=googleCallback';
$nonce = bin2hex(random_bytes(16));
$_SESSION['google_nonce'] = $nonce;

$google_url = "https://accounts.google.com/o/oauth2/v2/auth"
    . "?client_id=" . urlencode($client_id)
    . "&redirect_uri=" . urlencode($redirect_uri)
    . "&response_type=id_token"
    . "&scope=" . urlencode("openid email profile")
    . "&prompt=select_account"
    . "&nonce=" . $nonce;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barber Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">

</head>

<body class="login-page">
    <div class="login-container">
        <div class="login-header">
            <h1>BARBER SHOP</h1>
            <p>Inicia sesiÃ³n para continuar</p>
        </div>

        <div class="login-body">
            <?php if (isset($_GET["success"]) && $_GET["success"] === "password_changed"): ?>
                <div class="alert alert-success">âœ“ Tu contraseÃ±a ha sido cambiada exitosamente.</div>
            <?php endif; ?>
            <?php if (isset($_GET["success"]) && $_GET["success"] === "1" && isset($_GET["registered"])): ?>
                <div class="alert alert-success">âœ“ Â¡Registro exitoso! Ya puedes iniciar sesiÃ³n.</div>
            <?php endif; ?>
            <?php if (isset($_GET["logout"]) && $_GET["logout"] === "success"): ?>
                <div class="alert alert-info">
                    âœ“ Has cerrado sesiÃ³n correctamente.<br>
                    <small style="font-size: 0.82rem; line-height: 1.5; display: block; margin-top: 6px;">
                        Si iniciaste sesiÃ³n con Google, recuerda tambiÃ©n
                        <a href="https://accounts.google.com/logout" target="_blank" style="color: inherit; font-weight: 600;">
                            cerrar tu cuenta de Google
                        </a>
                        para que otra persona no pueda acceder.
                    </small>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET["error"]) && $_GET["error"] === "invalid_credentials"): ?>
                <div class="alert alert-error">âŒ Correo o contraseÃ±a incorrectos.</div>
            <?php endif; ?>
            <?php if (isset($_GET["error"]) && $_GET["error"] === "google_failed"): ?>
                <div class="alert alert-error">âŒ Error al iniciar sesiÃ³n con Google. Intenta de nuevo.</div>
            <?php endif; ?>
            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'cita'): ?>
                <div class="alert alert-warning">âš ï¸ Debes iniciar sesiÃ³n para reservar tu cita.</div>
            <?php endif; ?>

            <form action="index.php?action=login" method="POST">
                <div class="form-group">
                    <label for="correo">Correo ElectrÃ³nico</label>
                    <input type="email" id="correo" name="correo"
                        placeholder="ejemplo@correo.com" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="password">ContraseÃ±a</label>
                    <input type="password" id="password" name="password"
                        placeholder="Ingresa tu contraseÃ±a" required autocomplete="current-password">
                </div>
                <button type="submit" class="login-btn">Iniciar SesiÃ³n</button>
            </form>

            <p style="text-align:center; color:#888; margin: 16px 0 4px; font-size:13px;">â€” O continÃºa con â€”</p>


            <a href="<?= htmlspecialchars($google_url) ?>" class="btn-google">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                Acceder con Google
            </a>

            <div class="forgot-password">
                <a href="index.php?action=recuperar_password">Â¿Olvidaste tu contraseÃ±a?</a>
            </div>

            

            <div class="register-section">
                <p>Â¿No tienes una cuenta?</p>
                <div style="width:100%; box-sizing:border-box;">
                    <a href="index.php?action=register" class="register-btn"
                       style="display:block; width:100%; box-sizing:border-box; text-align:center;">
                        RegÃ­strate Ahora
                    </a>
                </div>
            </div>

            <div style="width:100%; text-align:center; margin-top:18px; box-sizing:border-box;">
                <a href="index.php?action=principal"
                   style="display:block; width:100%; text-align:center; box-sizing:border-box;
                          color:rgba(255,255,255,0.45); font-size:0.82rem;
                          text-decoration:none; padding:10px 0;">
                    â† Volver al inicio
                </a>
            </div>
        </div>
    </div>
</body>

</html>
