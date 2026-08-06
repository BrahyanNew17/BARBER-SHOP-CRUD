<?php

if (!isset($base)) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
}

require_once(__DIR__ . "/../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$idCategoria = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;

$sqlCategoria = "SELECT categoria FROM categoria WHERE idCategoria = :id";
$stmtCat = $conn->prepare($sqlCategoria);
$stmtCat->bindParam(':id', $idCategoria);
$stmtCat->execute();
$categoriaInfo = $stmtCat->fetch(PDO::FETCH_ASSOC);
$nombreCategoria = $categoriaInfo ? $categoriaInfo['categoria'] : 'Productos';

$sql = "SELECT 
            p.idProducto,
            p.nomProduc,
            p.descripcion,
            p.foto,
            p.precioUni,
            p.cantidad,
            m.marca,
            c.categoria
        FROM producto p
        LEFT JOIN marca m ON p.idMarca = m.idMarca
        LEFT JOIN categoria c ON p.idCategoria = c.idCategoria
        WHERE p.idCategoria = :idCategoria
        ORDER BY p.idProducto ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':idCategoria', $idCategoria);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nombreCategoria) ?> | Barber Shop</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">
    
</head>

<body>
    <?php include './views/includes/header.php'; ?>

    <div class="container py-5">
        <h1 class="titulo-categoria"><?= htmlspecialchars($nombreCategoria) ?></h1>

        <?php if (count($productos) > 0): ?>

            
            <div class="busqueda-wrapper">
                <span class="busqueda-icono">🔍</span>
                <input type="text"
                       id="busquedaProducto"
                       placeholder="Buscar producto..."
                       onkeyup="buscarProducto()">
                <button class="busqueda-clear" id="btnClearProducto" onclick="limpiarBusqueda('busquedaProducto', 'btnClearProducto')" style="display:none;">✕</button>
            </div>

            <div class="row g-4" id="contenedorProductos">
                <?php foreach ($productos as $p): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 producto-item"
                         data-producto="<?= strtolower(htmlspecialchars($p['nomProduc'])) ?>">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?= $base ?>/photo/<?= htmlspecialchars($p['foto']); ?>"
                                    alt="<?= htmlspecialchars($p['nomProduc']); ?>"
                                    onerror="this.src='https://via.placeholder.com/200x200/1a1a1a/d4af37?text=Sin+Imagen'">
                            </div>

                            <div class="product-content">
                                <div>
                                    <h5><?= htmlspecialchars($p['nomProduc']); ?></h5>
                                    <p><?= htmlspecialchars($p['descripcion']); ?></p>
                                    <p>
                                        <?= $p['cantidad'] > 0 
                                        ? 'Disponibles: ' . htmlspecialchars($p['cantidad']) 
                                        : 'Agotado'; ?>
                                        </p>
                                </div>

                                <button class="precio"
                                    onclick="agregar('<?= htmlspecialchars($p['nomProduc']); ?>', <?= $p['precioUni']; ?>, <?= $p['idProducto']; ?>, <?= (int)$p['cantidad']; ?>)"
                                    <?= ($p['cantidad'] <= 0) ? 'disabled style="opacity:0.5;cursor:not-allowed;background:#555;"' : '' ?>>
                                    <?= ($p['cantidad'] <= 0) ? 'Sin stock' : '$' . number_format($p['precioUni'], 0, ',', '.') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-productos">
                <i>📦</i>
                <h3>No hay productos en esta categoría</h3>
                <p>Próximamente agregaremos más productos</p>
            </div>
        <?php endif; ?>

        <div class="text-center mt-5">
            <a href="index.php?action=productobarberia" class="btn-volver">
                ← Volver a Productos
            </a>
        </div>
    </div>

    <div class="cart-btn" data-bs-toggle="modal" data-bs-target="#cartModal">
        🛒
    </div>

    
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">🛒 Carrito de Compras</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <div id="cartItems"></div>

                    <div id="emptyCart" class="empty-cart-state" style="display: none;">
                        <div class="empty-cart-icon">🛒</div>
                        <p class="empty-cart-text">Tu carrito está vacío</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="w-100">
                        <div class="cart-total-section">
                            <div class="total-label">Total</div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="total-amount">
                                    $<span id="cartTotal">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-finalizar" onclick="irACheckout()">
                                Finalizar compra
                            </button>
                            <button class="btn btn-vaciar" onclick="vaciarCarrito()">
                                🗑️ Vaciar carrito
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

        const cartItemsContainer = document.getElementById("cartItems");
        const cartTotal = document.getElementById("cartTotal");
        const emptyCart = document.getElementById("emptyCart");

        function guardar() {
            localStorage.setItem("carrito", JSON.stringify(carrito));
            mostrar();
        }

        function agregar(nombre, precio, idProducto, stockDisponible) {
            <?php if (!isset($_SESSION['user']) && !isset($_SESSION['rol'])): ?>
                if (confirm(`Debes iniciar sesión para agregar productos al carrito.\n\n¿Deseas ir a iniciar sesión ahora?`)) {
                    window.location.href = 'index.php?action=login1';
                }
                return;
            <?php endif; ?>

            let producto = carrito.find(p => p.idProducto === idProducto);
            let cantidadActual = producto ? producto.cantidad : 0;

            if (cantidadActual >= stockDisponible) {
                alert(`Solo hay ${stockDisponible} unidad(es) disponible(s) de "${nombre}".`);
                return;
            }

            if (confirm(`¿Deseas añadir "${nombre}" al carrito?`)) {
                if (producto) {
                    producto.cantidad++;
                } else {
                    carrito.push({ nombre, precio, cantidad: 1, idProducto, stock: stockDisponible });
                }
                guardar();
            }
        }

        function aumentarCantidad(index) {
            let item = carrito[index];
            if (item.cantidad >= item.stock) {
                alert(`Solo hay ${item.stock} unidad(es) disponible(s) de "${item.nombre}".`);
                return;
            }
            carrito[index].cantidad++;
            guardar();
        }

        function disminuirCantidad(index) {
            if (carrito[index].cantidad > 1) {
                carrito[index].cantidad--;
                guardar();
            } else {
                eliminarProducto(index);
            }
        }

        function eliminarProducto(index) {
            const items = document.querySelectorAll('.cart-item');
            if (items[index]) {
                items[index].classList.add('cart-item-removing');
            }

            setTimeout(() => {
                carrito.splice(index, 1);
                guardar();
            }, 400);
        }

        function irACheckout() {
            if (carrito.length === 0) {
                alert('Tu carrito está vacío.');
                return;
            }
            window.location.href = 'index.php?action=checkout';
        }

        function vaciarCarrito() {
            if (carrito.length === 0) return;

            if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                carrito = [];
                guardar();
            }
        }

        function mostrar() {
            if (carrito.length === 0) {
                cartItemsContainer.style.display = 'none';
                emptyCart.style.display = 'block';
                cartTotal.textContent = '0';
                return;
            }

            cartItemsContainer.style.display = 'block';
            emptyCart.style.display = 'none';
            cartItemsContainer.innerHTML = "";
            let total = 0;

            carrito.forEach((p, i) => {
                let subtotal = p.precio * p.cantidad;
                total += subtotal;

                cartItemsContainer.innerHTML += `
                <div class="cart-item">
                    <button class="delete-btn" onclick="eliminarProducto(${i})">
                        ✕
                    </button>
                    
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div class="product-name">${p.nombre}</div>
                            <div class="product-unit-price">
                                $${p.precio.toLocaleString()} c/u
                            </div>
                        </div>
                        
                        <div class="col-6 col-md-3 mb-2 mb-md-0">
                            <div class="quantity-control">
                                <button class="quantity-btn" onclick="disminuirCantidad(${i})">−</button>
                                <span class="quantity-display">${p.cantidad}</span>
                                <button class="quantity-btn" onclick="aumentarCantidad(${i})">+</button>
                            </div>
                        </div>
                        
                        <div class="col-6 col-md-3 text-end">
                            <div class="subtotal-price">
                                $${subtotal.toLocaleString()}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            });

            cartTotal.textContent = total.toLocaleString();
        }

        document.addEventListener("DOMContentLoaded", mostrar);

        function buscarProducto() {
            const input = document.getElementById("busquedaProducto");
            const texto = input.value.toLowerCase();
            const btnClear = document.getElementById("btnClearProducto");
            const items = document.querySelectorAll(".producto-item");
            let encontrados = 0;

            btnClear.style.display = texto.length > 0 ? "block" : "none";

            items.forEach(item => {
                const nombre = item.dataset.producto;
                if (nombre.includes(texto) || texto === "") {
                    item.style.display = "block";
                    encontrados++;
                } else {
                    item.style.display = "none";
                }
            });

            let mensaje = document.getElementById("sinResultados");
            if (encontrados === 0) {
                if (!mensaje) {
                    document.getElementById("contenedorProductos").insertAdjacentHTML("beforeend", `
                        <div id="sinResultados">
                            ❌ No se encontraron productos con ese nombre
                        </div>
                    `);
                }
            } else {
                if (mensaje) mensaje.remove();
            }
        }

        function limpiarBusqueda(inputId, btnId) {
            const input = document.getElementById(inputId);
            input.value = "";
            document.getElementById(btnId).style.display = "none";
            document.querySelectorAll(".producto-item").forEach(i => i.style.display = "block");
            const msg = document.getElementById("sinResultados");
            if (msg) msg.remove();
            input.focus();
        }
    </script>
    <footer class="footer">
        <p class="footer-text">© 2026 <span>Barber Shop®</span> — Todos los derechos reservados</p>
       <a href="/docs/Manual_De_Usuario_Barberia.pdf" 
       class="footer-manual" 
       download>
       Descargar Manual de Usuario
    </a>
    </footer>
</body>

</html>
