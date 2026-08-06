<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login1&msg=cita");
    exit();
}

$nombreComplet = $_SESSION['nombreComplet'] ?? '';
$numDocum      = $_SESSION['numDocum'] ?? '';
$correo        = $_SESSION['user']['correo'] ?? '';
$direccion     = $_SESSION['user']['direccion'] ?? '';
$Telefono      = $_SESSION['user']['Telefono'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Barber Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
<link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
    
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="py-4 text-center">
    <h1>Finalizar Compra</h1>
</section>
<?php if (isset($_GET['error']) && $_GET['error'] === 'datos_incompletos'): ?>
    <div class="alert alert-danger mx-3">❌ El carrito está vacío o faltan datos. Por favor revisa tu pedido.</div>
<?php endif; ?>

<main class="container mb-5">
<div class="row g-4">

    
    <div class="col-12 col-lg-7">

        <h3 class="mb-3">Datos del Cliente</h3>

        <div class="mb-3">
            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" name="nombreComplet"
                value="<?= htmlspecialchars($nombreComplet) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número de Documento</label>
            <input type="text" class="form-control" name="numDocum"
                value="<?= htmlspecialchars($numDocum) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="correo"
                value="<?= htmlspecialchars($correo) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion"
                value="<?= htmlspecialchars($direccion) ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="Telefono"
                value="<?= htmlspecialchars($Telefono) ?>" required>
        </div>

        <h3 class="mb-3">Método de Pago</h3>

        <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="metodoPago" value="efectivo" id="efectivo" required>
            <label class="form-check-label" for="efectivo">
                Efectivo (Pago en el local)
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="metodoPago" value="tarjeta" id="tarjeta" required>
            <label class="form-check-label" for="tarjeta">
                Tarjeta (Visa / Mastercard)
            </label>
        </div>

        <form id="formVenta" method="POST" action="index.php?action=procesarVenta">
            <input type="hidden" name="numDocum" value="<?= htmlspecialchars($numDocum) ?>">
            <input type="hidden" name="nombreComplet" id="hiddenNombre">
            <input type="hidden" name="correo" id="hiddenCorreo">
            <input type="hidden" name="direccion" id="hiddenDireccion">
            <input type="hidden" name="Telefono" id="hiddenTelefono">
            <input type="hidden" name="metodoPago" id="hiddenMetodo">
            <input type="hidden" name="total" id="inputTotal">
            <input type="hidden" name="itemsCarrito" id="inputItems">
        </form>

        <button type="button" class="btn btn-dark w-100" id="btnConfirmar">
            CONFIRMAR PEDIDO
        </button>

    </div>

    
    <div class="col-12 col-lg-5">

        <div class="card shadow-lg border-0 resumen-negro">
            <div class="card-body">
                <h3 class="mb-3">Resumen</h3>
                <div id="resumenItems"></div>
                <hr>
                <h4 class="mt-3">
                    TOTAL: $<span id="resumenTotal" class="fw-bold text-warning">0</span>
                </h4>
            </div>
        </div>

    </div>

</div>
</main>

<script>
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

if (carrito.length === 0) {
    window.location.href = 'index.php?action=productobarberia';
}

const resumenItems = document.getElementById('resumenItems');
let total = 0;

carrito.forEach(p => {
    const sub = p.precio * p.cantidad;
    total += sub;

    resumenItems.innerHTML += `
        <div class="mb-2 pb-2 border-bottom" style="border-color: rgba(255,255,255,0.2);">
            <strong>${p.nombre}</strong><br>
            Cantidad: ${p.cantidad}<br>
            Subtotal: $${sub.toLocaleString('es-CO')}
        </div>
    `;
});

document.getElementById('resumenTotal').textContent =
    total.toLocaleString('es-CO');

document.getElementById('btnConfirmar').addEventListener('click', () => {

    const metodo = document.querySelector('input[name="metodoPago"]:checked');

    if (!metodo) {
        alert("Selecciona un método de pago");
        return;
    }

    document.getElementById('hiddenNombre').value    = document.querySelector('input[name="nombreComplet"]').value;
    document.getElementById('hiddenCorreo').value    = document.querySelector('input[name="correo"]').value;
    document.getElementById('hiddenDireccion').value = document.querySelector('input[name="direccion"]').value;
    document.getElementById('hiddenTelefono').value  = document.querySelector('input[name="Telefono"]').value;
    document.getElementById('hiddenMetodo').value    = metodo.value;
    document.getElementById('inputTotal').value      = total;
    document.getElementById('inputItems').value      = JSON.stringify(carrito);

    localStorage.removeItem('carrito');
    document.getElementById('formVenta').submit();
});
</script>

</body>
</html>
