<?php
// Iniciar sesión para verificar si el usuario ya está logueado
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technological Innovation - Tienda de Tecnología</title>
    <meta name="description" content="Tienda virtual de tecnología, gadgets, computadoras y más. Los mejores productos tech al mejor precio.">
    <meta name="keywords" content="tecnología, tienda, gadgets, computadoras, innovación, tech, electrónicos">
    <link rel="canonical" href="https://www.technological-innovation.com/">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="styles/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
</head>
<body>
    <!-- Header -->
    <header class="text-center p-5 bg-light">
        <div class="container">
            <h1 class="display-4 fw-bold">Bienvenido a Technological Innovation</h1>
            <p class="lead">Tu Tienda de Confianza en Tecnología y Accesorios de Última Generación</p>
        </div>
    </header>

    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background-color: #d9d5cc;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="index.php">
                <img src="assets/img/logo.png" alt="Logo Technological Innovation" width="40" height="40" class="me-2">
                Technological Innovation
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="modulos/catalogo.php">
                            <i class="fas fa-store me-1"></i>Productos
                        </a>
                    </li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <!-- Usuario logueado -->
                        <li class="nav-item">
                            <a class="nav-link" href="modulos/perfil.php">
                                <i class="fas fa-user me-1"></i><?= htmlspecialchars($_SESSION['nombre'] ?? 'Mi Cuenta') ?>
                            </a>
                        </li>
                        <?php if ($_SESSION['rol'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="modulos/admin/dashboard.php">
                                    <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="modulos/historial_pedidos.php">
                                    <i class="fas fa-history me-1"></i>Mis Pedidos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="modulos/carrito.php">
                                    <i class="fas fa-shopping-cart me-1"></i>Carrito
                                    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                                        <span class="badge bg-danger"><?= count($_SESSION['carrito']) ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="modulos/logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Usuario no logueado -->
                        <li class="nav-item">
                            <a class="nav-link" href="modulos/registro.php">
                                <i class="fas fa-user-plus me-1"></i>Registro
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="modulos/login.php">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carruseles y secciones principales -->
    <main class="container my-5">
        <section class="row g-4">
            <!-- Categorías -->
            <div class="col-lg-4">
                <div class="text-center mb-3">
                    <h2 class="h3 fw-bold">Categorías</h2>
                    <p class="text-muted">Encuentra lo último en tecnología</p>
                </div>
                <div class="card shadow-sm">
                    <div id="categoriasCarousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#categoriasCarousel1" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#categoriasCarousel1" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#categoriasCarousel1" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner" style="height: 300px;">
                            <div class="carousel-item active">
                                <img src="assets/img/mouse.jpg" class="d-block w-100 h-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/audifonos.jpg" class="d-block w-100 h-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/teclados.jpg" class="d-block w-100 h-100">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#categoriasCarousel1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#categoriasCarousel1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Soporte -->
            <div class="col-lg-4">
                <div class="text-center h-100 d-flex flex-column justify-content-center">
                    <div class="card shadow-sm h-100 d-flex flex-column justify-content-center">
                        <div class="card-body text-center">
                            <i class="fas fa-headset fa-3x text-success mb-3"></i>
                            <h2 class="h3 fw-bold mb-3">Soporte Técnico</h2>
                            <p class="mb-4">¿Necesitas ayuda? Nuestro equipo está listo para asistirte</p>
                            <a href="https://wa.me/573222799496?text=Hola,%20necesito%20soporte%20técnico" 
                               target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg mb-3">
                                <i class="fab fa-whatsapp me-2"></i>Contactar Ahora
                            </a>
                            <div class="mt-3">
                                <img src="assets/img/atencion.jpg" 
                                     class="img-fluid rounded shadow-sm" 
                                     alt="Soporte técnico especializado" 
                                     style="max-width: 200px; max-height: 150px; object-fit: cover;" 
                                     loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promociones -->
            <div class="col-lg-4">
                <div class="text-center mb-3">
                    <h2 class="h3 fw-bold">Promociones</h2>
                    <p class="text-muted">Aprovecha nuestras ofertas exclusivas</p>
                </div>
                <div class="card shadow-sm">
                    <div id="categoriasCarousel2" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#categoriasCarousel2" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#categoriasCarousel2" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#categoriasCarousel2" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner" style="height: 300px;">
                            <div class="carousel-item active">
                                <img src="assets/img/aros.jpg" class="d-block w-100 h-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/reloj.jpg" class="d-block w-100 h-100"> 
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/camara.jpg" class="d-block w-100 h-100">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#categoriasCarousel2" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#categoriasCarousel2" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Sección destacada -->
    <section class="seccion-destacada text-center py-5 bg-primary text-white">
        <div class="container">
            <h2 class="display-4 fw-bold mb-4">¡Explora lo último en tecnología!</h2>
            <p class="lead fs-5 mb-4">Encuentra gadgets, computadoras, accesorios y mucho más en un solo lugar</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="modulos/catalogo.php" class="btn btn-light btn-lg">
                    <i class="fas fa-store me-2"></i>Ver Catálogo
                </a>
                <?php if (!isset($_SESSION['id'])): ?>
                    <a href="modulos/registro.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Tarjetas de presentación -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-truck display-4 text-primary mb-3"></i>
                            <h3 class="card-title h5 fw-bold">Envíos Rápidos</h3>
                            <p class="card-text">Recibe tus productos en tiempo récord con nuestros envíos eficientes y seguros a nivel nacional.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                            <h3 class="card-title h5 fw-bold">Pagos Seguros</h3>
                            <p class="card-text">Tus transacciones están protegidas con tecnología de cifrado avanzada y múltiples métodos de pago.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-headset display-4 text-primary mb-3"></i>
                            <h3 class="card-title h5 fw-bold">Soporte 24/7</h3>
                            <p class="card-text">Nuestro equipo especializado está disponible para resolver todas tus dudas en cualquier momento.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Sobre Nosotros -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <img src="assets/img/nosotros.jpg" alt="Equipo Technological Innovation" 
                                 class="img-fluid rounded shadow" style="height: 250px; width: 100%; object-fit: cover;" loading="lazy">
                        </div>
                        <div class="col-12">
                            <img src="assets/img/mision.jpg" alt="Nuestra misión en tecnología" 
                                 class="img-fluid rounded shadow" style="height: 250px; width: 100%; object-fit: cover;" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pe-lg-5">
                        <h2 class="fw-bold mb-4">Sobre Nosotros</h2>
                        <p class="lead">Technological Innovation es una tienda virtual dedicada a ofrecer lo mejor en tecnología a precios accesibles.</p>
                        
                        <p>Desde nuestro inicio, nos hemos comprometido con la innovación y la excelencia en el servicio, brindando productos confiables, soporte continuo y una experiencia de compra excepcional para todos nuestros clientes.</p>
                        
                        <h3 class="fw-bold mt-4 mb-3">Nuestra Historia</h3>
                        <p>Todo comenzó con una simple idea: hacer que la tecnología avanzada sea accesible para todos. Fundada por Yonathan Gil, Technological Innovation nació como un pequeño emprendimiento con la misión de ofrecer productos tecnológicos de vanguardia a precios competitivos.</p>
                        
                        <h3 class="fw-bold mt-4 mb-3">Nuestra Misión</h3>
                        <p>En Technological Innovation, nuestra misión es clara: impulsar el futuro a través de la tecnología. Queremos que cada persona, sin importar su nivel de conocimiento técnico, pueda disfrutar de las ventajas que la tecnología ofrece.</p>
                        
                        <div class="mt-4">
                            <a href="https://wa.me/573222799496?text=Hola,%20me%20gustaría%20conocer%20más%20sobre%20Technological%20Innovation" 
                               target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">
                                <i class="fab fa-whatsapp me-2"></i>Contáctanos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script personalizado para mejorar la experiencia -->
    <script>
        // Lazy loading mejorado
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.src;
            });
        }
        
        // Smooth scrolling para enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>