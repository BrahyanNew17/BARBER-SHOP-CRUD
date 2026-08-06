<?php if (!isset($base)) { $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARBER SHOP® | Barbería & Tienda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= $base ?>/css/estilos.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'] . $base . '/css/estilos.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= $base ?>/photo/favicon.png">

    
</head>

<body>
    <?php include 'includes/header.php'; ?>

    
    <section class="hero" id="inicio">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-eyebrow">Est. 2026 â€” Profesionales</span>
            <h1 class="hero-title">
                Barber
                <span>ShopÂ®</span>
            </h1>
            <img src="<?= $base ?>/photo/bienvenidos.png" alt="Bienvenidos" style="width:260px;height:160px;object-fit:cover;border-radius:8px;margin:14px auto;display:block;box-shadow:0 8px 30px rgba(0,0,0,0.6);border:1px solid rgba(212,175,55,0.25);">
            <p class="hero-subtitle">
                Cortes modernos y clÃ¡sicos, afeitados profesionales y tratamientos capilares.
                Tu imagen, nuestro arte.
            </p>
            <a href="<?= isset($_SESSION['user']) ? 'index.php?action=insertCita' : 'index.php?action=login1&msg=cita' ?>"
               class="hero-cta">Reserva tu cita</a>
        </div>
      
    </section>

    
    <section class="section servicios-section" id="servicios">
        <div class="container">
            <div class="reveal">
                <span class="section-label">Lo que hacemos</span>
                <h2 class="section-title">Nuestros Servicios</h2>
                <div class="section-divider"></div>
            </div>
            <div class="servicios-grid reveal reveal-delay-1">
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/corteservicio.jpg" alt="Corte" class="servicio-img">
                    <p class="servicio-nombre">Corte</p>
                </div>
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/cejaservicio.jpg" alt="Cejas" class="servicio-img">
                    <p class="servicio-nombre">Cejas</p>
                </div>
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/barbaservicio.jpg" alt="Barba" class="servicio-img">
                    <p class="servicio-nombre">Barba</p>
                </div>
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/corte+barba.jpg" alt="Corte + Barba" class="servicio-img">
                    <p class="servicio-nombre">Corte + Barba</p>
                </div>
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/corte+cejas.png" alt="Corte + Cejas" class="servicio-img">
                    <p class="servicio-nombre">Corte + Cejas</p>
                </div>
                <div class="servicio-item">
                    <img src="<?= $base ?>/photo/corte+barba+cejas.jpg" alt="Corte + Barba + Cejas" class="servicio-img">
                    <p class="servicio-nombre">Corte + Barba + Cejas</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section nosotros-section" id="nosotros">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <div class="nosotros-img-wrap">
                        <div class="nosotros-frame"></div>
                        <img src="<?= $base ?>/photo/sobre_nosotros.jpg" alt="Equipo Barber Shop">
                    </div>
                </div>
                <div class="col-lg-6 reveal reveal-delay-2">
                    <div class="nosotros-content">
                        <span class="section-label">QuiÃ©nes somos</span>
                        <h2 class="section-title">TradiciÃ³n & Estilo Moderno</h2>
                        <div class="section-divider"></div>
                        <p class="nosotros-texto">
                            En <strong style="color:var(--gold)">Barber Shop</strong> combinamos tradiciÃ³n y estilo moderno para ofrecerte una experiencia Ãºnica.
                            Nuestro equipo estÃ¡ formado por barberos certificados, apasionados por su arte y comprometidos con la excelencia.
                        </p>
                        <p class="nosotros-texto">
                            Cada visita es una oportunidad para renovar tu imagen y disfrutar de un momento especial en un ambiente acogedor.
                        </p>
                        <ul class="nosotros-lista">
                            <li>Barberos profesionales y amigables</li>
                            <li>Instalaciones modernas y cÃ³modas</li>
                            <li>Productos de alta calidad</li>
                            <li>AtenciÃ³n personalizada</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section productos-section" id="productos">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">Nuestra tienda</span>
                <h2 class="section-title">Productos Destacados</h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="productos-grid">
                <div class="producto-card reveal reveal-delay-1">
                    <img src="<?= $base ?>/photo/cortadoramagicclip.jpg" alt="Cortadora Magic Clip" class="producto-img">
                    <p class="producto-nombre">Cortadora Magic Clip</p>
                </div>
                <div class="producto-card reveal reveal-delay-2">
                    <img src="<?= $base ?>/photo/ceraoriginal.jpg" alt="Cera Original" class="producto-img">
                    <p class="producto-nombre">Cera Original</p>
                </div>
                <div class="producto-card reveal reveal-delay-3">
                    <img src="<?= $base ?>/photo/aceitedebarba.jpg" alt="Aceite para barba" class="producto-img">
                    <p class="producto-nombre">Aceite para barba Wood & Spice</p>
                </div>
                <div class="producto-card reveal reveal-delay-4">
                    <img src="<?= $base ?>/photo/navajafeather.png" alt="Navaja Feather" class="producto-img">
                    <p class="producto-nombre">Navaja Profesional Feather</p>
                </div>
                <div class="producto-card reveal reveal-delay-5">
                    <img src="<?= $base ?>/photo/espumaparabarba.jpg" alt="Espuma Proraso" class="producto-img">
                    <p class="producto-nombre">Espuma de afeitar Proraso</p>
                </div>
            </div>
            <div class="text-center mt-5 reveal">
                <a href="index.php?action=productobarberia" class="hero-cta">Ver todos los productos</a>
            </div>
        </div>
    </section>

    
    <section class="section contacto-section" id="contacto">
        <div class="container">
            <div class="text-center reveal mb-5">
                <span class="section-label">EncuÃ©ntranos</span>
                <h2 class="section-title">Contacto</h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5 reveal reveal-delay-1">
                    <div class="contacto-card">
                        <img src="<?= $base ?>/photo/whatsapp.png" alt="WhatsApp" class="contacto-icon">
                        <div>
                            <p class="contacto-label">WhatsApp</p>
                            <p class="contacto-valor">3202166561</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 reveal reveal-delay-2">
                    <div class="contacto-card">
                        <img src="<?= $base ?>/photo/gmail.png" alt="Email" class="contacto-icon">
                        <div>
                            <p class="contacto-label">Email</p>
                            <p class="contacto-valor">proyectobarbershop17@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="footer">
        <p class="footer-text">Â© 2026 <span>Barber ShopÂ®</span> â€” Todos los derechos reservados</p>
        <a href="/docs/Manual_De_Usuario_Barberia.pdf" 
       class="footer-manual" 
       download>
       Descargar Manual de Usuario
    </a>
    </footer>

    <script>
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.12 });
        reveals.forEach(el => observer.observe(el));
    </script>
</body>
</html>

