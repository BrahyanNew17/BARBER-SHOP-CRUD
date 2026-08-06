<?php
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php?action=principal");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Devoluciones | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
    <style>
        :root { --gold:#d4af37; --gold-dark:#b8962f; }
        body { background:#0a0a0a !important; color:#fff !important; font-family:'Quicksand',sans-serif; }

        .admin-header {
            background:#111;
            border-bottom:1px solid rgba(212,175,55,.15);
            padding:80px 20px 30px;
            text-align:center;
        }
        .admin-header h1 {
            color:var(--gold) !important;
            font-size:clamp(1.6rem,3vw,2.4rem);
            font-weight:700;
        }

        .alerta { padding:12px 20px; border-radius:8px; margin:16px 0; font-weight:600; font-size:.9rem; }
        .alerta-ok  { background:rgba(40,167,69,.15); border:1px solid rgba(40,167,69,.4); color:#6fcf97; }
        .alerta-err { background:rgba(220,53,69,.15); border:1px solid rgba(220,53,69,.4); color:#eb5757; }

        /* tarjeta por devolución */
        .dev-card {
            background:rgba(255,255,255,.03);
            border:1px solid rgba(212,175,55,.15);
            border-radius:12px;
            padding:24px;
            margin-bottom:20px;
            transition:border-color .3s;
        }
        .dev-card:hover { border-color:rgba(212,175,55,.35); }
        .dev-card.pendiente { border-left:4px solid #ffc107; }
        .dev-card.aprobada  { border-left:4px solid #28a745; }
        .dev-card.rechazada { border-left:4px solid #dc3545; }

        .dev-num  { font-size:.75rem; letter-spacing:3px; text-transform:uppercase; color:var(--gold); }
        .dev-prod { font-size:1.1rem; font-weight:700; color:#fff; margin:4px 0; }
        .dev-meta { font-size:.82rem; color:rgba(255,255,255,.45); }

        .badge-estado {
            padding:5px 16px; border-radius:20px; font-size:.72rem; font-weight:700; letter-spacing:1px;
        }
        .badge-Pendiente { background:rgba(255,193,7,.15); border:1px solid rgba(255,193,7,.4); color:#ffc107; }
        .badge-Aprobada  { background:rgba(40,167,69,.15);  border:1px solid rgba(40,167,69,.4); color:#28a745; }
        .badge-Rechazada { background:rgba(220,53,69,.15);  border:1px solid rgba(220,53,69,.4); color:#dc3545; }

        .motivo-box {
            background:rgba(255,255,255,.04);
            border:1px solid rgba(255,255,255,.08);
            border-radius:6px;
            padding:12px 16px;
            font-size:.88rem;
            color:rgba(255,255,255,.7) !important;
            margin:12px 0;
        }

        select.form-select-dark, textarea.form-textarea-dark {
            background:rgba(255,255,255,.05);
            border:1px solid rgba(212,175,55,.25);
            color:#fff;
            border-radius:6px;
            padding:10px 14px;
            width:100%;
            font-family:'Quicksand',sans-serif;
            outline:none;
        }
        select.form-select-dark:focus, textarea.form-textarea-dark:focus {
            border-color:var(--gold);
        }
        select.form-select-dark option { background:#111; }
        textarea.form-textarea-dark { resize:vertical; min-height:70px; }

        .btn-aprobar  { background:linear-gradient(135deg,#28a745,#1e8c38); color:#fff; border:none; padding:9px 24px; border-radius:6px; font-weight:700; font-size:.85rem; cursor:pointer; transition:all .3s; }
        .btn-rechazar { background:transparent; border:1px solid rgba(220,53,69,.5); color:#dc3545 !important; padding:9px 24px; border-radius:6px; font-weight:700; font-size:.85rem; cursor:pointer; transition:all .3s; }
        .btn-rechazar:hover { background:rgba(220,53,69,.1); }

        .empty-state { text-align:center; padding:60px 20px; color:rgba(255,255,255,.3); font-size:1rem; }
        .empty-state .icon { font-size:52px; margin-bottom:16px; opacity:.3; display:block; }

        .stats-bar {
            display:flex; gap:16px; flex-wrap:wrap; margin-bottom:32px;
        }
        .stat-pill {
            background:rgba(255,255,255,.04);
            border:1px solid rgba(212,175,55,.15);
            border-radius:8px;
            padding:14px 22px;
            text-align:center;
            flex:1; min-width:120px;
        }
        .stat-num  { font-size:1.6rem; font-weight:800; color:var(--gold); }
        .stat-lbl  { font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.4); }

        .btn-volver {
            background:transparent; border:1px solid rgba(212,175,55,.4);
            color:var(--gold) !important; padding:10px 24px; border-radius:6px;
            text-decoration:none; font-weight:600; font-size:.88rem;
            display:inline-block; transition:all .3s; margin-bottom:24px;
        }
        .btn-volver:hover { background:rgba(212,175,55,.1); border-color:var(--gold); }
    </style>
</head>
<body>

<?php include './views/includes/header.php'; ?>
<br>
<div class="admin-header">
    <h1>🔄 Gestión de Devoluciones</h1>
    <p style="color:rgba(255,255,255,.5); font-size:.9rem; margin-top:8px;">
        Administra las solicitudes de devolución de los clientes
    </p>
</div>

<main class="container py-5">

    

    <?php if (isset($_GET['success'])): ?>
        <div class="alerta alerta-ok">✅ Devolución actualizada correctamente. El inventario fue ajustado si correspondía.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alerta alerta-err">❌ Error al procesar. Verifica los datos e intenta de nuevo.</div>
    <?php endif; ?>

    
    <?php
    $pendientes = array_filter($devoluciones, fn($d) => $d['estado'] === 'Pendiente');
    $aprobadas  = array_filter($devoluciones, fn($d) => $d['estado'] === 'Aprobada');
    $rechazadas = array_filter($devoluciones, fn($d) => $d['estado'] === 'Rechazada');
    ?>
    <div class="stats-bar">
        <div class="stat-pill">
            <div class="stat-num"><?= count($devoluciones) ?></div>
            <div class="stat-lbl">Total</div>
        </div>
        <div class="stat-pill" style="border-color:rgba(255,193,7,.3);">
            <div class="stat-num" style="color:#ffc107;"><?= count($pendientes) ?></div>
            <div class="stat-lbl">Pendientes</div>
        </div>
        <div class="stat-pill" style="border-color:rgba(40,167,69,.3);">
            <div class="stat-num" style="color:#28a745;"><?= count($aprobadas) ?></div>
            <div class="stat-lbl">Aprobadas</div>
        </div>
        <div class="stat-pill" style="border-color:rgba(220,53,69,.3);">
            <div class="stat-num" style="color:#dc3545;"><?= count($rechazadas) ?></div>
            <div class="stat-lbl">Rechazadas</div>
        </div>
    </div>

    <?php if (empty($devoluciones)): ?>
        <div class="empty-state">
            <span class="icon">✅</span>
            No hay solicitudes de devolución registradas.
        </div>
    <?php else: ?>

        <?php foreach ($devoluciones as $dev): ?>
        <div class="dev-card <?= strtolower($dev['estado']) ?>">

            <div class="row align-items-start">

                
                <div class="col-md-7 mb-3 mb-md-0">
                    <div class="dev-num">Devolución #<?= str_pad($dev['idDevolucion'], 4, '0', STR_PAD_LEFT) ?> · Pedido #<?= str_pad($dev['idVentaProducto'], 5, '0', STR_PAD_LEFT) ?></div>
                    <div class="dev-prod"><?= htmlspecialchars($dev['nomProduc']) ?></div>
                    <div class="dev-meta">
                        👤 <?= htmlspecialchars($dev['nombreComplet'] ?? 'N/A') ?> 
                        · 📄 <?= htmlspecialchars($dev['numDocum'] ?? '') ?>
                        · ✉️ <?= htmlspecialchars($dev['correo'] ?? '') ?>
                    </div>
                    <div class="dev-meta" style="margin-top:4px;">
                        📦 Cantidad: <strong style="color:#fff;"><?= $dev['cantidadDevuelta'] ?></strong>
                        · 📅 <?= date('d/m/Y H:i', strtotime($dev['fechaSolicitud'] . ' ' . $dev['horaSolicitud'])) ?>
                    </div>
                    <div class="motivo-box">
                        <strong style="color:rgba(255,255,255,.5); font-size:.7rem; text-transform:uppercase; letter-spacing:1px;">Motivo:</strong><br>
                        <?= nl2br(htmlspecialchars($dev['motivo'])) ?>
                    </div>
                </div>

                
                <div class="col-md-5">
                    <div style="margin-bottom:12px;">
                        <span class="badge-estado badge-<?= $dev['estado'] ?>"><?= $dev['estado'] ?></span>
                    </div>

                    <?php if ($dev['estado'] === 'Pendiente'): ?>
                    <form action="index.php?action=actualizarDevolucion" method="POST">
                        <input type="hidden" name="idDevolucion" value="<?= $dev['idDevolucion'] ?>">

                        <div style="margin-bottom:10px;">
                            <label style="font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.4); display:block; margin-bottom:6px;">Resolución</label>
                            <select name="estado" class="form-select-dark" required>
                                <option value="">— Seleccionar —</option>
                                <option value="Aprobada">✅ Aprobar devolución</option>
                                <option value="Rechazada">❌ Rechazar devolución</option>
                            </select>
                        </div>

                        <div style="margin-bottom:14px;">
                            <label style="font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,.4); display:block; margin-bottom:6px;">Observación (opcional)</label>
                            <textarea name="observacion" class="form-textarea-dark" placeholder="Ej: Devolución aprobada, el reembolso se procesará en 3-5 días..."></textarea>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn-aprobar">Confirmar</button>
                        </div>
                    </form>
                    <?php else: ?>
                        <?php if ($dev['observacion']): ?>
                            <div class="motivo-box" style="margin-top:0;">
                                <strong style="color:rgba(255,255,255,.5); font-size:.7rem; text-transform:uppercase; letter-spacing:1px;">Observación:</strong><br>
                                <?= nl2br(htmlspecialchars($dev['observacion'])) ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($dev['fechaRespuesta']): ?>
                            <div class="dev-meta">Respondida: <?= date('d/m/Y', strtotime($dev['fechaRespuesta'])) ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php endforeach; ?>

    <?php endif; ?>
    <a href="index.php?action=dashboard" class="btn-volver">← Volver al Dashboard</a>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer mt-4">
    <p class="footer-text">© 2026 <span>Barber Shop®</span> — Panel Administrativo</p>
</footer>
</body>
</html>

