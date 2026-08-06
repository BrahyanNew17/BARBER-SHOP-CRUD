<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
    <style>
    body {
        background-image: url("../photo/fondo-login.jpg")!important;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
</head>
<body class="register-page">
    
    <div class="register-wrapper">
        <div class="container-register shadow-lg p-4 rounded" style="background: rgba(0,0,0,0.75); border: 2px solid #D4AF37; width: 100%;">
            <div class="Titulo-Register text-center mb-4" style="color: #D4AF37; font-size: 2rem; font-weight: bold; letter-spacing: 2px;">
                
                <p>Crear Cuenta Nueva</p>
            </div>
            <?php
            // Mostrar mensajes de error
            if (isset($_GET['error'])) {
                $errorMessages = [
                    'empty_fields' => 'Por favor completa todos los campos',
                    'invalid_email' => 'El correo electrÃ³nico no es vÃ¡lido',
                    'email_exists' => 'Este correo ya estÃ¡ registrado',
                    'document_exists' => 'Este documento ya estÃ¡ registrado',
                    'password_short' => 'La contraseÃ±a debe tener al menos 6 caracteres',
                    'passwords_dont_match' => 'Las contraseÃ±as no coinciden',
                    'invalid_phone' => 'El telÃ©fono debe tener al menos 7 dÃ­gitos',
                    'system_error' => 'Error del sistema. Intenta mÃ¡s tarde'
                ];
                $error = $_GET['error'];
                if (isset($errorMessages[$error])) {
                    echo '<div class="alert alert-error">âŒ ' . $errorMessages[$error] . '</div>';
                }
            }
            
            // Mostrar mensaje de Ã©xito
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<div class="alert alert-success">âœ“ Â¡Registro exitoso! Ya puedes iniciar sesiÃ³n.</div>';
            }
            ?>
            <form action="index.php?action=registerUser" method="POST">
                <label for="nombreComplet">Nombre Completo:</label>
                <input type="text" name="nombreComplet" id="nombreComplet" 
                       placeholder="Ej: Juan PÃ©rez GarcÃ­a" 
                       value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>"
                       required>
                
                <label for="numDocum">NÃºmero de Documento:</label>
                <input type="text" name="numDocum" id="numDocum" 
                       placeholder="Ej: 1234567890" 
                       value="<?= isset($_GET['documento']) ? htmlspecialchars($_GET['documento']) : '' ?>"
                       required>
                
               
   <div class="mb-3">
    <label for="idtipoDoc" class="form-label">Tipo de Documento</label>

    <select name="idtipoDoc" id="idtipoDoc" class="form-select" required>
        <option value="" selected disabled>Seleccione tipo de documento</option>

        <?php if (isset($docums) && is_array($docums)): ?>
            <?php foreach ($docums as $docum): ?>
                <option value="<?= htmlspecialchars($docum['idtipoDoc']); ?>">
                    <?= htmlspecialchars($docum['tipoDocumento']); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="1">CC</option>
            <option value="2">CE</option>
            <option value="3">RC</option>
            <option value="4">SS</option>
            <option value="5">TI</option>
        <?php endif; ?>
    </select>
</div>

                
                <label for="Telefono">TelÃ©fono:</label>
                <input type="tel" name="Telefono" id="Telefono" 
                       placeholder="Ej: 3001234567" 
                       value="<?= isset($_GET['telefono']) ? htmlspecialchars($_GET['telefono']) : '' ?>"
                       required>
                
                <label for="direccion">DirecciÃ³n:</label>
                <input type="text" name="direccion" id="direccion" 
                       placeholder="Ej: Calle 123 #45-67" 
                       value="<?= isset($_GET['direccion']) ? htmlspecialchars($_GET['direccion']) : '' ?>"
                       required>
                
                <label for="correo">Correo ElectrÃ³nico:</label>
                <input type="email" name="correo" id="correo" 
                       placeholder="Ej: tu@email.com" 
                       value="<?= isset($_GET['correo']) ? htmlspecialchars($_GET['correo']) : '' ?>"
                       required>
                
                <label for="password">ContraseÃ±a:</label>
                <input type="password" name="password" id="password" 
                       placeholder="MÃ­nimo 6 caracteres" 
                       required>
                <div class="password-requirements">
                    * MÃ­nimo 6 caracteres
                </div>
                
                <label for="password_confirm">Confirmar ContraseÃ±a:</label>
                <input type="password" name="password_confirm" id="password_confirm" 
                       placeholder="Repite tu contraseÃ±a" 
                       required>
                
                <input type="submit" value="Registrarse">
            </form>
            <div class="links-container mt-3 text-center">
                <p>Â¿Ya tienes cuenta? <a href="index.php?action=login">Inicia sesiÃ³n aquÃ­</a></p>
            </div>
        </div>
    </div>
</body>
</html>
