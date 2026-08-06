<?php
if (!isset($_SESSION['factura'])) {
    header("Location: index.php?action=productobarberia");
    exit();
}
$factura = $_SESSION['factura'];
unset($_SESSION['factura']); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura | Barber Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="contacto-hero reveal">
    <span class="section-label">✅ Pedido confirmado</span>
    <h1 class="contacto-hero-title">¡Gracias por tu compra!</h1>
    <div class="section-divider mx-auto"></div>
    <p class="contacto-hero-sub">Tu pedido fue registrado exitosamente. Aquí está tu factura.</p>
</section>

<main class="container contacto-main">

    <div class="factura-wrap reveal reveal-delay-1" id="facturaImprimir">

        <!-- HEADER RESPONSIVE -->
        <div class="factura-header row">

            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <h2 class="factura-logo">Barber Shop<span>®</span></h2>
                <p class="factura-sub">Barbería & Tienda | Est. 2026</p>
                <p class="factura-sub">📍 Cunday, Tolima | 📞 +57 3202166561</p>
            </div>

            <div class="col-12 col-md-6 text-md-end">
                <p class="factura-num">
                    Factura N° 
                    <strong><?= str_pad($factura['idVenta'], 6, '0', STR_PAD_LEFT) ?></strong>
                </p>
                <p class="factura-fecha">Fecha: <?= $factura['fecha'] ?></p>
                <p class="factura-fecha">Hora: <?= $factura['hora'] ?></p>
                <span class="factura-badge"><?= htmlspecialchars($factura['metodoPago']) ?></span>
            </div>

        </div>

        <!-- CLIENTE -->
        <div class="factura-cliente">
            <p><span class="factura-campo">Cliente:</span> <?= htmlspecialchars($factura['nombre']) ?></p>
            <p><span class="factura-campo">Documento:</span> <?= htmlspecialchars($factura['numDocum']) ?></p>
            <p><span class="factura-campo">Correo:</span> <?= htmlspecialchars($factura['correo']) ?></p>
        </div>

        <!-- TABLA RESPONSIVE -->
        <div class="table-responsive">
            <table class="factura-tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end">Precio Unit.</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($factura['items'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nombre']) ?></td>
                        <td class="text-center"><?= $item['cantidad'] ?></td>
                        <td class="text-end">$<?= number_format($item['precio'], 0, ',', '.') ?></td>
                        <td class="text-end">$<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="factura-total-row">
                        <td colspan="3" class="text-end">TOTAL</td>
                        <td class="text-end">$<?= number_format($factura['total'], 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- PIE -->
        <div class="factura-pie">
            <p>💈 <strong>¡Gracias por confiar en Barber Shop!</strong></p>
            <p>Este documento es un comprobante de tu compra.</p>
        </div>

    </div>

    <!-- BOTONES RESPONSIVE -->
    <div class="text-center mt-4 reveal reveal-delay-2 d-flex flex-column flex-md-row gap-3 justify-content-center">
        <button class="contacto-btn" style="max-width:260px;" onclick="imprimirFactura()">🖨️ Imprimir / Descargar</button>
        <a href="index.php?action=productobarberia"
           class="contacto-btn"
           style="max-width:260px; text-align:center; text-decoration:none; display:inline-block;">
           Seguir Comprando
        </a>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
reveals.forEach(el => observer.observe(el));

localStorage.removeItem('carrito');

function imprimirFactura() {
    const contenido = document.getElementById('facturaImprimir').innerHTML;
    const ventana = window.open('', '_blank');
    if (!ventana) {
        alert('Por favor, permite ventanas emergentes para imprimir la factura.');
        return;
    }
    ventana.document.write(`
        <html>
        <head>
            <title>Factura Barber Shop</title>
            <style>
                body { font-family: 'Quicksand', sans-serif; padding: 40px; color: #111; background: #fff; }
                .factura-header { display:flex; justify-content: space-between; border-bottom:2px solid #d4af37; padding-bottom:10px; margin-bottom:20px; }
                table { width:100%; border-collapse: collapse; margin-top:20px; }
                th { background-color:#111; color:#d4af37; padding:10px; text-align:left; }
                td { padding:10px; border-bottom:1px solid #ddd; }
                .text-end { text-align:right; }
                .text-center { text-align:center; }
            </style>
        </head>
        <body>${contenido}</body>
        </html>
    `);
    ventana.document.close();
    ventana.print();
}
</script>

<footer class="footer">
    <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
</footer>

</body>
</html>
