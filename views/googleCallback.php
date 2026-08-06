<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciando sesión...</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #1a1a2e;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .msg { text-align: center; }
        .spinner {
            width: 44px; height: 44px;
            border: 4px solid #333;
            border-top-color: #f0c040;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 16px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        p { font-size: 15px; color: #aaa; }
    </style>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<body>
<div class="msg">
    <div class="spinner"></div>
    <p>Verificando cuenta de Google...</p>
</div>
<script>
(function() {
    // Google devuelve el id_token en el fragmento (#id_token=xxx&token_type=...&...)
    var hash = window.location.hash.substring(1);
    var params = {};
    hash.split('&').forEach(function(part) {
        var kv = part.split('=');
        if (kv[0]) params[decodeURIComponent(kv[0])] = decodeURIComponent(kv[1] || '');
    });

    var idToken = params['id_token'];

    if (!idToken) {
        window.location.href = 'index.php?action=login1&error=google_failed';
        return;
    }

    // Decodificar JWT para extraer email y nombre
    function parseJwt(token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var json = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(json);
    }

    var data;
    try {
        data = parseJwt(idToken);
    } catch(e) {
        window.location.href = 'index.php?action=login1&error=google_failed';
        return;
    }

    // Enviar al servidor
    fetch('index.php?action=googleLogin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            email: data.email,
            name:  data.name,
            sub:   data.sub
        })
    })
    .then(function(res) { return res.json(); })
    .then(function(result) {
        if (result.success) {
            window.location.href = result.redirect;
        } else {
            window.location.href = 'index.php?action=login1&error=google_failed';
        }
    })
    .catch(function() {
        window.location.href = 'index.php?action=login1&error=google_failed';
    });
})();
</script>
</body>
</html>
