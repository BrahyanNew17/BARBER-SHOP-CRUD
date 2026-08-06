<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login1");
    exit();
}
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Devolución | Barber Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css">
    <style>
        :root{--gold:#d4af37;--gold-dark:#b8962f}
        body{background:#000!important;color:#fff!important;font-family:'Quicksand',sans-serif}

        .page-hero{text-align:center;padding:80px 20px 40px;background:#111;border-bottom:1px solid rgba(212,175,55,.15)}
        .page-hero h1{font-family:'Playfair Display',serif;font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:8px}
        .page-hero p{color:rgba(255,255,255,.55);font-size:.95rem}
        .section-label{font-size:.7rem;letter-spacing:5px;text-transform:uppercase;color:var(--gold);margin-bottom:12px;display:block}

        .alerta{padding:14px 20px;border-radius:8px;margin:20px 0;font-weight:600;font-size:.9rem}
        .alerta-ok {background:rgba(40,167,69,.15);border:1px solid rgba(40,167,69,.4);color:#6fcf97}
        .alerta-err{background:rgba(220,53,69,.15);border:1px solid rgba(220,53,69,.4);color:#eb5757}

        .card-form{background:rgba(255,255,255,.03);border:1px solid rgba(212,175,55,.2);border-radius:12px;padding:36px;margin-bottom:32px}
        .card-form h2{font-family:'Playfair Display',serif;color:var(--gold)!important;font-size:1.4rem;margin-bottom:24px;padding-bottom:14px;border-bottom:1px solid rgba(212,175,55,.15)}

        label{display:block;font-size:.75rem;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.5)!important;margin-bottom:7px}
        select,textarea,input[type=number]{width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(212,175,55,.25);border-radius:6px;padding:12px 14px;color:#fff;font-family:'Quicksand',sans-serif;font-size:.95rem;transition:border-color .3s;outline:none}
        select:focus,textarea:focus,input[type=number]:focus{border-color:var(--gold)}
        select option{background:#111;color:#fff}
        textarea{resize:vertical;min-height:90px}

        
        .prod-row{
            display:grid;
            grid-template-columns:1fr 100px auto;
            gap:12px;
            align-items:end;
            background:rgba(212,175,55,.05);
            border:1px solid rgba(212,175,55,.2);
            border-radius:8px;
            padding:16px;
            margin-bottom:12px;
            position:relative;
        }
        .prod-row .prod-name{font-weight:700;color:#fff;font-size:.95rem;margin-bottom:4px}
        .prod-row .prod-stock{font-size:.78rem;color:rgba(255,255,255,.4)}
        .btn-remove-prod{
            background:rgba(220,53,69,.15);
            border:1px solid rgba(220,53,69,.3);
            color:#dc3545;
            border-radius:6px;
            padding:8px 14px;
            cursor:pointer;
            font-size:1rem;
            line-height:1;
            transition:all .2s;
            align-self:center;
        }
        .btn-remove-prod:hover{background:rgba(220,53,69,.3)}

        
        .add-prod-row{
            display:grid;
            grid-template-columns:1fr auto;
            gap:10px;
            align-items:end;
            margin-bottom:16px;
        }
        .btn-add-prod{
            background:rgba(212,175,55,.12);
            border:1px solid rgba(212,175,55,.35);
            color:var(--gold);
            font-weight:700;
            font-size:.85rem;
            padding:12px 20px;
            border-radius:6px;
            cursor:pointer;
            white-space:nowrap;
            transition:all .3s;
        }
        .btn-add-prod:hover{background:rgba(212,175,55,.22);border-color:var(--gold)}

        .empty-prod{
            text-align:center;
            padding:24px;
            color:rgba(255,255,255,.3);
            font-size:.88rem;
            border:1px dashed rgba(212,175,55,.2);
            border-radius:8px;
            margin-bottom:16px;
        }

        .btn-gold{background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#000;font-weight:700;font-size:.9rem;letter-spacing:1px;border:none;padding:14px 36px;border-radius:6px;cursor:pointer;transition:all .3s;box-shadow:0 4px 15px rgba(212,175,55,.3)}
        .btn-gold:hover{background:linear-gradient(135deg,#f4d03f,var(--gold));transform:translateY(-2px);box-shadow:0 8px 25px rgba(212,175,55,.5)}
        .btn-gold:disabled{opacity:.5;cursor:not-allowed;transform:none}

        
        .dev-table{width:100%;border-collapse:collapse;font-size:.88rem}
        .dev-table th{font-size:.68rem;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.4);padding:10px 14px;border-bottom:1px solid rgba(212,175,55,.15)}
        .dev-table td{padding:12px 14px;border-bottom:1px solid rgba(255,255,255,.05);color:rgba(255,255,255,.8)!important}
        .dev-table tr:last-child td{border-bottom:none}
        .badge-estado{padding:4px 14px;border-radius:20px;font-size:.72rem;font-weight:700;letter-spacing:1px}
        .badge-Pendiente{background:rgba(255,193,7,.15);border:1px solid rgba(255,193,7,.4);color:#ffc107}
        .badge-Aprobada {background:rgba(40,167,69,.15);border:1px solid rgba(40,167,69,.4);color:#28a745}
        .badge-Rechazada{background:rgba(220,53,69,.15);border:1px solid rgba(220,53,69,.4);color:#dc3545}

        .btn-volver{background:transparent;border:1px solid rgba(212,175,55,.4);color:var(--gold)!important;padding:10px 28px;border-radius:6px;text-decoration:none;font-weight:600;font-size:.88rem;transition:all .3s;display:inline-block}
        .btn-volver:hover{background:rgba(212,175,55,.1);border-color:var(--gold)}

        
        .resumen-item{display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05);font-size:.88rem}
        .resumen-item:last-child{border-bottom:none}

        @media(max-width:576px){
            .prod-row{grid-template-columns:1fr}
            .add-prod-row{grid-template-columns:1fr}
        }
    </style>
</head>
<body>

<?php include './views/includes/header.php'; ?>

<div class="page-hero">
    <span class="section-label">↩ Devoluciones</span>
    <h1>Solicitar Devolución</h1>
    <p>Selecciona el pedido y todos los productos que deseas devolver en una sola solicitud.</p>
</div>

<main class="container py-5">

    <?php if (isset($_GET['success'])): ?>
        <div class="alerta alerta-ok">✅ Solicitud registrada exitosamente. Te contactaremos pronto.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <?php $msgs=['datos_incompletos'=>'Completa todos los campos y selecciona al menos un producto.','no_autorizado'=>'No tienes permiso para devolver este pedido.','ya_existe'=>'Ya existe una solicitud activa para uno de esos productos.']; ?>
        <div class="alerta alerta-err">❌ <?= htmlspecialchars($msgs[$_GET['error']] ?? 'Ocurrió un error. Inténtalo de nuevo.') ?></div>
    <?php endif; ?>

    <div class="row g-4">

        
        <div class="col-lg-7">
            <div class="card-form">
                <h2>Nueva Solicitud</h2>

                <?php if (empty($pedidos)): ?>
                    <p style="color:rgba(255,255,255,.4);text-align:center;padding:30px 0">📦 No tienes pedidos registrados aún.</p>
                <?php else: ?>

                <form id="formDevolucion" action="index.php?action=procesarDevolucion" method="POST">

                    
                    <div class="mb-4">
                        <label>Pedido</label>
                        <select id="selectPedido" name="idVentaProducto" required onchange="cargarProductosDisponibles()">
                            <option value="">— Selecciona un pedido —</option>
                            <?php
                            $pedidosUnicos = [];
                            foreach ($pedidos as $p) {
                                $id = $p['idVentaProducto'];
                                if (!isset($pedidosUnicos[$id])) $pedidosUnicos[$id] = $p;
                            }
                            foreach ($pedidosUnicos as $id => $p):
                            ?>
                            <option value="<?= $id ?>">
                                Pedido #<?= str_pad($id,5,'0',STR_PAD_LEFT) ?> — <?= date('d/m/Y',strtotime($p['fecha'])) ?> — $<?= number_format($p['total'],0,',','.') ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    
                    <div id="seccionProductos" style="display:none">
                        <label style="margin-bottom:12px">Productos a devolver</label>

                        
                        <div class="add-prod-row">
                            <div>
                                <select id="selectAgregar">
                                    <option value="">— Selecciona un producto —</option>
                                </select>
                            </div>
                            <button type="button" class="btn-add-prod" onclick="agregarProducto()">+ Añadir</button>
                        </div>

                        
                        <div id="listaProductos">
                            <div class="empty-prod" id="emptyProd">
                                Aún no has añadido productos. Selecciona uno arriba y haz clic en Añadir.
                            </div>
                        </div>

                        
                        <div id="hiddenInputs"></div>
                    </div>

                    
                    <div class="mb-4" id="seccionMotivo" style="display:none">
                        <label>Motivo de la devolución</label>
                        <textarea name="motivo" id="motivoTexto" placeholder="Describe el motivo de la devolución..." required></textarea>
                    </div>

                    <button type="submit" class="btn-gold w-100" id="btnEnviar" style="display:none" disabled>
                        Enviar Solicitud
                    </button>
                </form>

                <?php endif; ?>
            </div>

            <a href="index.php?action=misPedidos" class="btn-volver">← Volver a Mis Pedidos</a>
        </div>

        
        <div class="col-lg-5">
            <div class="card-form">
                <h2>Mis Solicitudes</h2>

                <?php if (empty($devolucionesActivas)): ?>
                    <p style="color:rgba(255,255,255,.4);text-align:center;padding:20px 0;font-size:.9rem">
                        Aún no tienes solicitudes de devolución.
                    </p>
                <?php else: ?>
                    <div style="overflow-x:auto">
                    <table class="dev-table">
                        <thead>
                            <tr>
                                <th>Sol.</th>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($devolucionesActivas as $d): ?>
                            <tr>
                                <td>#<?= str_pad($d['idDevolucion'],4,'0',STR_PAD_LEFT) ?></td>
                                <td><?= htmlspecialchars($d['nomProduc']) ?></td>
                                <td><?= $d['cantidadDevuelta'] ?></td>
                                <td><?= date('d/m/Y',strtotime($d['fechaSolicitud'])) ?></td>
                                <td>
                                    <span class="badge-estado badge-<?= $d['estado'] ?>"><?= $d['estado'] ?></span>
                                    <?php if ($d['observacion']): ?>
                                        <br><small style="color:rgba(255,255,255,.35)"><?= htmlspecialchars($d['observacion']) ?></small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<script>
const pedidosData = <?= json_encode($pedidos, JSON_UNESCAPED_UNICODE) ?>;


let productosSeleccionados = {};

function cargarProductosDisponibles() {
    const idVenta = parseInt(document.getElementById('selectPedido').value);
    productosSeleccionados = {};
    renderLista();

    document.getElementById('seccionProductos').style.display = idVenta ? 'block' : 'none';
    document.getElementById('seccionMotivo').style.display    = 'none';
    document.getElementById('btnEnviar').style.display        = 'none';

    const sel = document.getElementById('selectAgregar');
    sel.innerHTML = '<option value="">— Selecciona un producto —</option>';

    if (!idVenta) return;

    const items = pedidosData.filter(p => parseInt(p.idVentaProducto) === idVenta);
    items.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.idProducto;
        opt.dataset.nombre = item.nomProduc;
        opt.dataset.max    = item.cantidad;
        opt.textContent    = `${item.nomProduc}  (disponible: ${item.cantidad})`;
        sel.appendChild(opt);
    });
}

function agregarProducto() {
    const sel  = document.getElementById('selectAgregar');
    const opt  = sel.options[sel.selectedIndex];
    if (!opt || !opt.value) return;

    const id     = opt.value;
    const nombre = opt.dataset.nombre;
    const max    = parseInt(opt.dataset.max);

    if (productosSeleccionados[id]) {
        alert(`"${nombre}" ya fue añadido. Ajusta la cantidad directamente en la lista.`);
        return;
    }

    productosSeleccionados[id] = { nombre, max, cantidad: 1 };
    renderLista();

    
    opt.remove();
    sel.value = '';
}

function quitarProducto(id) {
    const p = productosSeleccionados[id];
    if (!p) return;

    
    const sel = document.getElementById('selectAgregar');
    const opt = document.createElement('option');
    opt.value          = id;
    opt.dataset.nombre = p.nombre;
    opt.dataset.max    = p.max;
    opt.textContent    = `${p.nombre}  (disponible: ${p.max})`;
    sel.appendChild(opt);

    delete productosSeleccionados[id];
    renderLista();
}

function cambiarCantidad(id, valor) {
    const v = parseInt(valor);
    if (!productosSeleccionados[id]) return;
    const max = productosSeleccionados[id].max;
    productosSeleccionados[id].cantidad = Math.min(Math.max(1, v), max);
    renderHiddens();
}

function renderLista() {
    const lista   = document.getElementById('listaProductos');
    const hiddens = document.getElementById('hiddenInputs');
    const empty   = document.getElementById('emptyProd');
    const ids     = Object.keys(productosSeleccionados);

    lista.innerHTML = '';

    if (ids.length === 0) {
        lista.appendChild(empty || (() => {
            const d = document.createElement('div');
            d.className = 'empty-prod';
            d.id = 'emptyProd';
            d.textContent = 'Aún no has añadido productos. Selecciona uno arriba y haz clic en Añadir.';
            return d;
        })());
        hiddens.innerHTML = '';
        document.getElementById('seccionMotivo').style.display = 'none';
        document.getElementById('btnEnviar').style.display     = 'none';
        document.getElementById('btnEnviar').disabled          = true;
        return;
    }

    ids.forEach(id => {
        const p   = productosSeleccionados[id];
        const row = document.createElement('div');
        row.className = 'prod-row';
        row.id = `row-${id}`;
        row.innerHTML = `
            <div>
                <div class="prod-name">${p.nombre}</div>
                <div class="prod-stock">Máx. ${p.max} unidad(es)</div>
            </div>
            <div>
                <label style="margin-bottom:4px">Cantidad</label>
                <input type="number" min="1" max="${p.max}" value="${p.cantidad}"
                    onchange="cambiarCantidad('${id}', this.value)"
                    oninput="cambiarCantidad('${id}', this.value)"
                    style="text-align:center">
            </div>
            <button type="button" class="btn-remove-prod" onclick="quitarProducto('${id}')" title="Quitar">✕</button>
        `;
        lista.appendChild(row);
    });

    renderHiddens();

    document.getElementById('seccionMotivo').style.display = 'block';
    document.getElementById('btnEnviar').style.display     = 'block';
    document.getElementById('btnEnviar').disabled          = false;
}

function renderHiddens() {
    const hiddens = document.getElementById('hiddenInputs');
    hiddens.innerHTML = '';
    Object.keys(productosSeleccionados).forEach((id, i) => {
        const p = productosSeleccionados[id];
        hiddens.innerHTML += `
            <input type="hidden" name="productos[${i}][idProducto]"      value="${id}">
            <input type="hidden" name="productos[${i}][cantidadDevuelta]" value="${p.cantidad}">
        `;
    });
}


document.getElementById('formDevolucion')?.addEventListener('submit', function(e) {
    if (Object.keys(productosSeleccionados).length === 0) {
        e.preventDefault();
        alert('Debes añadir al menos un producto para devolver.');
        return;
    }
    const motivo = document.getElementById('motivoTexto').value.trim();
    if (!motivo) {
        e.preventDefault();
        alert('Por favor escribe el motivo de la devolución.');
        return;
    }
    renderHiddens(); 
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<footer class="footer mt-5">
    <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
</footer>
</body>
</html>
