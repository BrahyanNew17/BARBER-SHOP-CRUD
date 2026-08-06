<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login1");
    exit();
}

require_once(__DIR__ . "/../config/database.php");
$database = new Database();
$conn = $database->getConnection();

$numDocum = $_SESSION['user']['numDocum'] ?? $_SESSION['numDocum'] ?? '';

$sqlVentas = "SELECT vp.idVentaProducto, vp.fecha, vp.hora, vp.total
              FROM ventaproducto vp
              WHERE vp.numDocum = ?
              ORDER BY vp.fecha DESC, vp.hora DESC";
$stmtV = $conn->prepare($sqlVentas);
$stmtV->execute([$numDocum]);
$ventas = $stmtV->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas as &$venta) {
    $sqlDet = "SELECT dvp.cantidad, dvp.precioUnitario, dvp.subTotal, p.nomProduc, p.foto
               FROM detalleventproducto dvp
               INNER JOIN producto p ON dvp.idProducto = p.idProducto
               WHERE dvp.idVentaProducto = ?";
    $stmtD = $conn->prepare($sqlDet);
    $stmtD->execute([$venta['idVentaProducto']]);
    $venta['items'] = $stmtD->fetchAll(PDO::FETCH_ASSOC);
}
unset($venta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos | Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
    <style>
        :root{--gold:#d4af37;--gold-dark:#b8962f}
        body{background:#000!important;color:#fff!important;font-family:'Quicksand',sans-serif}
        .page-hero{text-align:center;padding:80px 20px 36px;background:#111;border-bottom:1px solid rgba(212,175,55,.15)}
        .page-hero h1{font-family:'Playfair Display',serif;font-size:clamp(1.8rem,4vw,2.8rem);color:#fff}
        .page-hero p{color:rgba(255,255,255,.5);font-size:.95rem;margin-top:8px}
        .section-label{font-size:.7rem;letter-spacing:5px;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:10px}
        .pedido-card{background:rgba(255,255,255,.03);border:1px solid rgba(212,175,55,.15);border-radius:12px;margin-bottom:20px;overflow:hidden;transition:border-color .3s}
        .pedido-card:hover{border-color:rgba(212,175,55,.4)}
        .pedido-header{display:flex;justify-content:space-between;align-items:flex-start;padding:20px 24px;background:rgba(212,175,55,.05);border-bottom:1px solid rgba(212,175,55,.1);flex-wrap:wrap;gap:12px}
        .pedido-num{font-size:.75rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:4px}
        .pedido-fecha{font-size:.85rem;color:rgba(255,255,255,.5)}
        .pedido-total{font-size:1.3rem;font-weight:800;color:var(--gold)}
        .badge-pedido{background:rgba(212,175,55,.12);border:1px solid rgba(212,175,55,.3);color:var(--gold);font-size:.72rem;letter-spacing:1px;padding:4px 12px;border-radius:20px;white-space:nowrap}
        .pedido-body{padding:16px 24px}
        .item-row{display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.05)}
        .item-row:last-child{border-bottom:none}
        .item-img{width:48px;height:48px;border-radius:8px;object-fit:cover;border:1px solid rgba(212,175,55,.2);flex-shrink:0}
        .item-name{flex:1;font-weight:600;color:#fff!important;font-size:.9rem}
        .item-qty{font-size:.8rem;color:rgba(255,255,255,.45)!important;white-space:nowrap}
        .item-subtotal{font-weight:700;color:var(--gold)!important;white-space:nowrap}
        .pedido-actions{display:flex;gap:10px;flex-wrap:wrap;padding:16px 24px;border-top:1px solid rgba(255,255,255,.05);background:rgba(0,0,0,.2)}
        .btn-factura{background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#000!important;font-weight:700;font-size:.82rem;border:none;padding:9px 20px;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .3s;box-shadow:0 3px 10px rgba(212,175,55,.3)}
        .btn-factura:hover{background:linear-gradient(135deg,#f4d03f,var(--gold));transform:translateY(-1px);color:#000!important}
        .btn-devolver{background:transparent;border:1px solid rgba(212,175,55,.35);color:var(--gold)!important;font-weight:700;font-size:.82rem;padding:9px 20px;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .3s}
        .btn-devolver:hover{background:rgba(212,175,55,.08);border-color:var(--gold)}
        .empty-state{text-align:center;padding:80px 20px;background:rgba(255,255,255,.02);border:1px solid rgba(212,175,55,.12);border-radius:12px;margin:20px 0}
        .empty-state .icon{font-size:60px;opacity:.2;display:block;margin-bottom:16px}
        .empty-state p{color:rgba(255,255,255,.4);margin-bottom:20px}
        .btn-comprar{background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#000!important;font-weight:700;padding:14px 36px;border-radius:6px;text-decoration:none;display:inline-block;transition:all .3s}
        .btn-comprar:hover{transform:translateY(-2px)}
        .nav-bottom{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:32px}
        .btn-nav{background:rgba(255,255,255,.04);border:1px solid rgba(212,175,55,.2);color:rgba(255,255,255,.7)!important;font-weight:600;font-size:.88rem;padding:12px 28px;border-radius:6px;text-decoration:none;transition:all .3s;display:inline-block}
        .btn-nav:hover{border-color:var(--gold);color:#fff!important}
    </style>
</head>
<body>

<?php include './views/includes/header.php'; ?>

<div class="page-hero">
    <span class="section-label">📦 Historial</span>
    <h1>Mis Pedidos</h1>
    <p>Aquí puedes ver, descargar facturas y solicitar devoluciones de tus compras.</p>
</div>

<main class="container py-5">

    <?php if (empty($ventas)): ?>
        <div class="empty-state">
            <span class="icon">📦</span>
            <p>Aún no tienes pedidos registrados.</p>
            <a href="index.php?action=productobarberia" class="btn-comprar">Ir a la tienda</a>
        </div>
    <?php else: ?>

        <?php foreach ($ventas as $venta): ?>
        <div class="pedido-card">
            <div class="pedido-header">
                <div>
                    <div class="pedido-num">Pedido #<?= str_pad($venta['idVentaProducto'], 5, '0', STR_PAD_LEFT) ?></div>
                    <div class="pedido-fecha">
                        📅 <?= date('d/m/Y', strtotime($venta['fecha'])) ?>
                        &nbsp;·&nbsp;
                        🕐 <?= substr($venta['hora'], 0, 5) ?>
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge-pedido"><?= count($venta['items']) ?> producto(s)</span>
                    <div class="pedido-total mt-2">$<?= number_format($venta['total'], 0, ',', '.') ?></div>
                </div>
            </div>

            <div class="pedido-body">
                <?php foreach ($venta['items'] as $item): ?>
                <div class="item-row">
                    <img class="item-img"
                         src="<?= $base ?>/photo/<?= htmlspecialchars($item['foto']) ?>"
                         alt="<?= htmlspecialchars($item['nomProduc']) ?>"
                         onerror="this.src='https://via.placeholder.com/48x48/1a1a1a/d4af37?text=?'">
                    <div class="item-name"><?= htmlspecialchars($item['nomProduc']) ?></div>
                    <div class="item-qty">x<?= $item['cantidad'] ?> · $<?= number_format($item['precioUnitario'], 0, ',', '.') ?> c/u</div>
                    <div class="item-subtotal">$<?= number_format($item['subTotal'], 0, ',', '.') ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="pedido-actions">
                <a href="index.php?action=descargarFactura&id=<?= $venta['idVentaProducto'] ?>" class="btn-factura">
                    🧾 Descargar Factura
                </a>
                <a href="index.php?action=solicitarDevolucion" class="btn-devolver">
                    ↩ Solicitar Devolución
                </a>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="nav-bottom">
            <a href="index.php?action=productobarberia" class="btn-nav">🛍️ Seguir Comprando</a>
            <a href="index.php?action=solicitarDevolucion" class="btn-nav">↩ Mis Devoluciones</a>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <a href="index.php?action=dashboard" class="btn-nav">⚙️ Dashboard</a>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer mt-4">
    <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
</footer>
</body>
</html>
