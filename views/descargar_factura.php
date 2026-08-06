<?php

if (!isset($venta) || empty($venta)) {
    header("Location: index.php?action=misPedidos");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #<?= str_pad($venta['idVentaProducto'], 6, '0', STR_PAD_LEFT) ?> | Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
    <style>
        :root { --gold:#d4af37; --gold-dark:#b8962f; }
        body { background:#000 !important; color:#fff !important; font-family:'Quicksand',sans-serif; }

        .page-hero {
            text-align:center; padding:80px 20px 36px;
            background:#111; border-bottom:1px solid rgba(212,175,55,.15);
        }
        .page-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.5rem); color:#fff; }
        .section-label { font-size:.7rem; letter-spacing:5px; text-transform:uppercase; color:var(--gold); display:block; margin-bottom:10px; }

        /* ── Factura ── */
        .factura-wrap {
            background:rgba(255,255,255,.03);
            border:1px solid rgba(212,175,55,.2);
            border-radius:12px;
            padding:48px;
            max-width:840px;
            margin:0 auto;
        }
        .factura-header { display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:20px; padding-bottom:28px; border-bottom:1px solid rgba(212,175,55,.15); margin-bottom:28px; }
        .factura-logo { font-family:'Playfair Display',serif; font-size:2rem; font-weight:900; color:#fff !important; margin:0; }
        .factura-logo span { color:var(--gold); }
        .factura-sub  { font-size:.82rem; color:rgba(255,255,255,.4) !important; margin:4px 0 0; }
        .factura-num  { font-size:.9rem;  color:rgba(255,255,255,.7) !important; margin:0; }
        .factura-fecha{ font-size:.82rem; color:rgba(255,255,255,.4) !important; margin:4px 0 0; }
        .factura-badge { display:inline-block; margin-top:8px; background:rgba(212,175,55,.15); border:1px solid rgba(212,175,55,.3); color:var(--gold) !important; font-size:.75rem; letter-spacing:2px; padding:4px 14px; border-radius:20px; }

        .factura-cliente { background:rgba(255,255,255,.02); border-radius:6px; padding:20px 24px; margin-bottom:28px; }
        .factura-cliente p { margin:4px 0; font-size:.9rem; color:rgba(255,255,255,.7) !important; }
        .factura-campo  { color:rgba(255,255,255,.4) !important; font-size:.75rem; letter-spacing:1px; text-transform:uppercase; margin-right:8px; }

        .factura-tabla { width:100%; border-collapse:collapse; margin-bottom:0; }
        .factura-tabla th { font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.4) !important; padding:10px 12px; border-bottom:1px solid rgba(212,175,55,.15); font-weight:600; }
        .factura-tabla td { padding:14px 12px; font-size:.92rem; color:rgba(255,255,255,.8) !important; border-bottom:1px solid rgba(255,255,255,.05); }
        .factura-total-row td { font-weight:800; font-size:1.1rem; color:var(--gold) !important; border-bottom:none; border-top:1px solid rgba(212,175,55,.2); padding-top:18px; }
        .factura-pie { text-align:center; margin-top:32px; padding-top:24px; border-top:1px solid rgba(212,175,55,.1); }
        .factura-pie p { font-size:.85rem; color:rgba(255,255,255,.4) !important; margin:4px 0; }

        /* Botones de acción */
        .btn-download {
            background:linear-gradient(135deg,var(--gold),var(--gold-dark));
            color:#000 !important; font-weight:700; border:none;
            padding:14px 36px; border-radius:6px; cursor:pointer;
            transition:all .3s; font-size:.95rem;
            box-shadow:0 4px 15px rgba(212,175,55,.35);
            text-decoration:none; display:inline-block;
        }
        .btn-download:hover { background:linear-gradient(135deg,#f4d03f,var(--gold)); transform:translateY(-2px); color:#000 !important; }

        .btn-outline {
            background:transparent; border:1px solid rgba(212,175,55,.4);
            color:var(--gold) !important; padding:14px 36px; border-radius:6px;
            text-decoration:none; font-weight:700; transition:all .3s; display:inline-block; font-size:.95rem;
        }
        .btn-outline:hover { background:rgba(212,175,55,.1); border-color:var(--gold); }

        @media print {
            body { background:#fff !important; color:#000 !important; }
            .no-print { display:none !important; }
            .factura-wrap { border:1px solid #ccc; padding:30px; box-shadow:none; background:#fff; }
            .factura-tabla th { color:#555 !important; background:#f5f5f5; }
            .factura-tabla td { color:#222 !important; }
            .factura-logo, .factura-num { color:#000 !important; }
            .factura-total-row td { color:#b8962f !important; }
        }

        @media (max-width: 768px) {
            .factura-wrap { padding:24px 18px; }
            .factura-header { flex-direction:column; }
        }
    </style>
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
</head>
<body>

<?php include './views/includes/header.php'; ?>


<div class="page-hero no-print">
    <span class="section-label">🧾 Historial de Compras</span>
    <h1>Factura de Pedido</h1>
    <p style="color:rgba(255,255,255,.5); font-size:.9rem; margin-top:8px;">
        Descarga o imprime el comprobante de tu compra
    </p>
</div>

<main class="container contacto-main">

    
    <div class="factura-wrap reveal reveal-delay-1" id="facturaImprimir">

        <div class="factura-header row">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <h2 class="factura-logo">Barber Shop<span>®</span></h2>
                <p class="factura-sub">Barbería & Tienda | Est. 2026</p>
                <p class="factura-sub">📍 Cunday, Tolima | 📞 +57 3202166561</p>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <p class="factura-num">Factura N° <strong><?= str_pad($venta['idVentaProducto'], 6, '0', STR_PAD_LEFT) ?></strong></p>
                <p class="factura-fecha">Fecha: <?= date('d/m/Y', strtotime($venta['fecha'])) ?></p>
                <p class="factura-fecha">Hora: <?= substr($venta['hora'], 0, 5) ?></p>
                <span class="factura-badge">COMPROBANTE DE COMPRA</span>
            </div>
        </div>

        
        <div class="factura-cliente">
            <p><span class="factura-campo">Cliente:</span> <?= htmlspecialchars($venta['nombreComplet']) ?></p>
            <p><span class="factura-campo">Documento:</span> <?= htmlspecialchars($venta['numDocum']) ?></p>
            <p><span class="factura-campo">Correo:</span> <?= htmlspecialchars($venta['correo']) ?></p>
            <?php if (!empty($venta['direccion'])): ?>
            <p><span class="factura-campo">Dirección:</span> <?= htmlspecialchars($venta['direccion']) ?></p>
            <?php endif; ?>
        </div>

        
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
                    <?php foreach ($venta['items'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nomProduc']) ?></td>
                        <td class="text-center"><?= (int)$item['cantidad'] ?></td>
                        <td class="text-end">$<?= number_format($item['precioUnitario'], 0, ',', '.') ?></td>
                        <td class="text-end">$<?= number_format($item['subTotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="factura-total-row">
                        <td colspan="3" class="text-end">TOTAL</td>
                        <td class="text-end">$<?= number_format($venta['total'], 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        
        <div class="factura-pie">
            <p>💈 <strong>¡Gracias por confiar en Barber Shop!</strong></p>
            <p>Este documento es un comprobante válido de tu compra.</p>
        </div>

    </div>

    
    <div class="text-center mt-4 d-flex flex-column flex-md-row gap-3 justify-content-center no-print">
        <button class="btn-download" onclick="imprimirFactura()">
            🖨️ Imprimir / Descargar PDF
        </button>
        <a href="index.php?action=misPedidos" class="btn-outline">
            ← Volver a Mis Pedidos
        </a>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>

const reveals = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
reveals.forEach(el => obs.observe(el));

function imprimirFactura() {
    const contenido = document.getElementById('facturaImprimir').innerHTML;
    const ventana   = window.open('', '_blank');
    if (!ventana) {
        alert('Permite ventanas emergentes en tu navegador para imprimir la factura.');
        return;
    }
    ventana.document.write(`
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Factura #<?= str_pad($venta['idVentaProducto'], 6, '0', STR_PAD_LEFT) ?> — Barber Shop</title>
            <style>
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body { font-family: 'Quicksand', Arial, sans-serif; padding: 40px; color: #111; background: #fff; }
                .factura-header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #d4af37; padding-bottom: 20px; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
                .factura-logo { font-size: 1.8rem; font-weight: 900; color: #000; }
                .factura-logo span { color: #d4af37; }
                .factura-sub, .factura-fecha { font-size: 0.8rem; color: #777; margin: 3px 0; }
                .factura-num { font-size: 0.9rem; color: #333; margin: 0; font-weight: 600; }
                .factura-badge { display: inline-block; background: #fff8e1; border: 1px solid #d4af37; color: #b8962f; font-size: 0.72rem; letter-spacing: 2px; padding: 3px 12px; border-radius: 20px; margin-top: 6px; }
                .factura-cliente { background: #f9f9f9; border-radius: 6px; padding: 16px 20px; margin-bottom: 24px; }
                .factura-cliente p { margin: 3px 0; font-size: 0.88rem; color: #444; }
                .factura-campo { color: #999; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; margin-right: 6px; }
                table { width: 100%; border-collapse: collapse; }
                th { background: #111; color: #d4af37; padding: 10px 12px; text-align: left; font-size: 0.72rem; letter-spacing: 2px; text-transform: uppercase; }
                td { padding: 12px; border-bottom: 1px solid #eee; font-size: 0.9rem; color: #333; }
                .text-end { text-align: right; }
                .text-center { text-align: center; }
                .factura-total-row td { font-weight: 800; font-size: 1.05rem; color: #b8962f; border-top: 2px solid #d4af37; border-bottom: none; padding-top: 14px; }
                .factura-pie { text-align: center; margin-top: 28px; padding-top: 20px; border-top: 1px solid #eee; color: #999; font-size: 0.82rem; }
            </style>
        </head>
        <body>
            ${contenido}
        </body>
        </html>
    `);
    ventana.document.close();
    setTimeout(() => ventana.print(), 400);
}
</script>

<footer class="footer mt-5 no-print">
    <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
</footer>
</body>
</html>

