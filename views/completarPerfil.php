<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//if (!isset($_SESSION['user'])) {
//header("Location: index.php?action=login1");
//exit();
//}
require_once __DIR__ . '/../config/database.php';
$database = new Database();
$pdo = $database->getConnection();
$tiposDoc = $pdo->query("SELECT idtipoDoc, tipoDocumento FROM tipodocumento")
                ->fetchAll(PDO::FETCH_ASSOC);



$nombre = $_SESSION['user']['nombreComplet'] ?? 'Usuario';
$primerNombre = htmlspecialchars(explode(' ', $nombre)[0]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completa tu Perfil - Barber Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/styles.css">
   <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<body>
<div class="wrapper">

    <div class="header">
        <span class="logo-text"> BARBER SHOP® | Barbería & Tienda </span>
        
        <h1>¡Hola, <span><?= $primerNombre ?>!</span></h1>
        <p>Solo nos faltan unos datos para<br>completar tu perfil y comenzar.</p>
    </div>

    <div class="card">
        <div class="divider">
            <span>Información personal</span>
        </div>

        <form method="POST" action="index.php?action=guardarPerfil">
            <div class="form-grid">

                <div class="form-group full">
                    <label>Número de Documento</label>
                    <div class="input-wrap">
                        <span class="ico">🪪</span>
                        <input type="number" name="numDocum" placeholder="Ej: 1234567890" required>
                    </div>
                </div>

                <div class="form-group full">
                    <label>Tipo de Documento</label>
                    <div class="input-wrap">
                        <span class="ico">📋</span>
<select name="idtipoDoc" required>
    <option value="">-- Selecciona --</option>
    <?php foreach ($tiposDoc as $tipo): ?>
        <option value="<?= $tipo['idtipoDoc'] ?>">
            <?= htmlspecialchars($tipo['tipoDocumento']) ?>
        </option>
    <?php endforeach; ?>
</select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <div class="input-wrap">
                        <span class="ico">📱</span>
                        <input type="tel" name="telefono" placeholder="3001234567" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <div class="input-wrap">
                        <span class="ico">📍</span>
                        <input type="text" name="direccion" placeholder="Calle 10 #5-20" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-wrap">
                        <span class="ico">🔒</span>
                        <input type="password" name="contraseña" placeholder="Mínimo 6 caracteres" minlength="6" required>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn-submit">
                Guardar y Continuar
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </form>
    </div>

    <p class="footer-note">Tu información es privada y segura 🔒</p>
</div>
</body>
</html>
