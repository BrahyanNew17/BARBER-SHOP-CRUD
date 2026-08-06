<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($base)) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
}
?>

<style>
   
    .navbar-custom {
        background: rgba(0, 0, 0, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        padding: 15px 0;
        font-family: 'Quicksand', sans-serif !important;
    }

    .navbar-custom * {
        font-family: 'Quicksand', sans-serif !important;
    }

    .navbar-brand {
        color: #d4af37 !important;
        font-size: 1.8rem;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .navbar-nav .nav-item {
        margin: 0 8px !important;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
        font-weight: 600;
        padding: 10px 18px !important;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1.2px;
    }

    .navbar-nav .nav-link:hover {
        color: #d4af37 !important;
        transform: translateY(-2px);
    }

    .btn-login {
        background: transparent;
        border: 2px solid #d4af37;
        color: #d4af37 !important;
        padding: 8px 25px;
        border-radius: 25px;
        font-weight: bold;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    .btn-login:hover {
        background: #d4af37;
        color: #000 !important;
        transform: scale(1.05);
    }

    .navbar-nav .nav-link.btn-logout {
        background: #d4af37 !important;
        border: 2px solid #d4af37 !important;
        color: #000 !important;
        padding: 8px 25px !important;
        border-radius: 25px !important;
        font-weight: bold !important;
        transition: all 0.3s ease !important;
        margin-left: 10px !important;
        text-shadow: none !important;
        transform: none !important;
    }

    .navbar-nav .nav-link.btn-logout:hover {
        background: transparent !important;
        color: #d4af37 !important;
        text-shadow: none !important;
    }

    

  
    .logo-barber {
        width: 60px;
        height: auto;
        margin-left: 15px;
        display: block; 
    }

    .navbar-toggler {
        border: none !important;
        padding: 8px 12px;
        background: transparent !important;
        box-shadow: none !important;
    }

    .navbar-toggler:focus,
    .navbar-toggler:active,
    .navbar-toggler:hover,
    .navbar-toggler[aria-expanded="true"] {
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
        border: none !important;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    }

    
    @media (max-width: 991px) {
        .navbar-collapse {
            background: rgba(0, 0, 0, 0.98);
            padding: 20px;
            margin-top: 15px;
            border-radius: 10px;
            border: none;
        }

        .navbar-nav .nav-link {
            padding: 12px 15px !important;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        .navbar-nav .nav-link:last-child {
            border-bottom: none;
        }

        .btn-login,
        .btn-logout,
        .btn-dashboard {
            width: 100%;
            margin: 10px 0;
            text-align: center;
        }

        .logo-barber {
            width: 50px;
            display: block; 
            margin-left: 0;
            margin-right: 12px;
        }

        .navbar-brand {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .logo-barber {
            width: 40px; 
            display: block;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container-fluid">
        
        
            <img src="<?= $base ?>/photo/LOGO_BARBER_SHOP.png" alt="Logo" class="logo-barber">
        

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php?action=principal">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php?action=serviciobarberia">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php?action=productobarberia">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php?action=sobre_nosotros">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php?action=contacto">Contacto</a>
                </li>

                <?php if (isset($_SESSION['user']) || isset($_SESSION['rol'])): ?>
                    
                    <li class="nav-item">
                        <a class="nav-link btn-dashboard" href="<?= $base ?>/index.php?action=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-logout" href="<?= $base ?>/index.php?action=logout">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="<?= $base ?>/index.php?action=login1">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
</nav>


<style>
    body { padding-top: 80px; }
    @media (max-width: 991px) { body { padding-top: 70px; } }
    @media (max-width: 576px) { body { padding-top: 65px; } }
</style>