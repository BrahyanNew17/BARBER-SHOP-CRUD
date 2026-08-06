<?php


if (!isset($_SESSION['emailData'])) {
    header("Location: index.php?action=recuperar_password&error=system_error");
    exit();
}


$emailData = $_SESSION['emailData'];
unset($_SESSION['emailData']);
session_write_close();   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviando correoâ€¦</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css">
</head>
<body>
    <div class="loading-container">
        <div class="spinner" id="spinner"></div>
        <h2 id="statusTitle">Enviando correo de recuperaciÃ³nâ€¦</h2>
        <p  id="statusText">Por favor, espera un momento.</p>
        <div class="debug" id="debugBox"></div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

    <script>
    (function () {
        
        var PUBLIC_KEY  = "IZDlQmOjLlUq6aSxU";
        var SERVICE_ID  = "service_q9ob2jg";
        var TEMPLATE_ID = "template_z1dkvcv";   
        
        var toEmail    = "<?php echo htmlspecialchars($emailData['to_email'],  ENT_QUOTES, 'UTF-8'); ?>";
        var toName     = "<?php echo htmlspecialchars($emailData['to_name'],   ENT_QUOTES, 'UTF-8'); ?>";
        var resetLink  = "<?php echo htmlspecialchars($emailData['reset_link'],ENT_QUOTES, 'UTF-8'); ?>";
       var userDocument = "<?php echo htmlspecialchars($emailData['document'], ENT_QUOTES, 'UTF-8'); ?>";


        
        var params = {
            email:      toEmail,
            to_name:    toName,
            link: resetLink,
            document:   userDocument
        };

        console.log("[EmailJS] ParÃ¡metros que se envÃ­an:", JSON.stringify(params, null, 2));

   
        emailjs.init(PUBLIC_KEY);

        emailjs.send(SERVICE_ID, TEMPLATE_ID, params)
        .then(function (response) {
            console.log("[EmailJS] âœ“ Enviado correctamente â€“", response.status, response.text);

            document.getElementById("spinner").style.display   = "none";
            document.getElementById("statusTitle").textContent = "Â¡Correo enviado!";
            document.getElementById("statusText").textContent  = "Revisa tu bandeja de entrada (y la de spam).";

           
            setTimeout(function () {
                window.location.href = "index.php?action=recuperar_password&message=email_sent";
            }, 2500);
        })
        .catch(function (error) {
            console.error("[EmailJS] âœ— Error:", error);

            document.getElementById("spinner").style.display   = "none";
            document.getElementById("statusTitle").textContent = "Error al enviar el correo";
            document.getElementById("statusText").textContent  = "Por favor, intenta nuevamente.";

           
            var debugBox = document.getElementById("debugBox");
            debugBox.style.display  = "block";
            debugBox.innerHTML      = "<strong>Error (desarrollo):</strong><br>" +
                                      "status: " + (error.status || "sin estado") + "<br>" +
                                      "text: "   + (error.text   || JSON.stringify(error));

            setTimeout(function () {
                window.location.href = "index.php?action=recuperar_password&error=email_failed";
            }, 4000);
        });
    })();
    </script>
</body>
</html>
