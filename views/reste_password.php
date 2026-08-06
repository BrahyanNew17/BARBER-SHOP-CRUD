<?php
require_once __DIR__ . '/../config/database.php';

$token = isset($_GET['token']) ? trim($_GET['token']) : '';

if (empty($token)) {
    header("Location: index.php?action=recuperar_password&error=token_missing");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare("SELECT numDocum FROM cliente WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->execute([$token]);

if ($stmt->rowCount() === 0) {
    header("Location: index.php?action=recuperar_password&error=token_invalid");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer ContraseÃ±a</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="90">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h1>Restablecer ContraseÃ±a</h1>
            <p>Ingresa tu nueva contraseÃ±a para recuperar el acceso.</p>
        </div>

        <div class="login-body">
            <?php if (isset($_GET['error']) && $_GET['error'] === 'short'): ?>
                <div class="alert alert-error">âœ— La contraseÃ±a debe tener al menos 6 caracteres.</div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=updatePassword">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-group">
                    <label for="password">Nueva ContraseÃ±a</label>
                    <input type="password" id="password" name="password" placeholder="MÃ­nimo 6 caracteres" required minlength="6">
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmar ContraseÃ±a</label>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Repite la contraseÃ±a" required minlength="6">
                </div>

                <button type="submit" class="login-btn">Cambiar ContraseÃ±a</button>
            </form>

            <div class="forgot-password">
                <a href="index.php?action=recuperar_password">â† Volver a recuperar contraseÃ±a</a>
            </div>
        </div>
    </div>

    <script>
    document.querySelector('form').addEventListener('submit', function (e) {
        var pwd  = document.getElementById('password').value;
        var pwd2 = document.getElementById('password_confirm').value;
        if (pwd.length < 6) {
            e.preventDefault();
            alert('La contraseÃ±a debe tener al menos 6 caracteres.');
            return;
        }
        if (pwd !== pwd2) {
            e.preventDefault();
            alert('Las contraseÃ±as no coinciden.');
            return;
        }
    });
    </script>
</body>
</html>
