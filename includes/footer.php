<?php
// Footer principal - includes/footer.php

// Determinar la ruta base según la ubicación del archivo
$base_path = '';
if (strpos($_SERVER['REQUEST_URI'], '/modulos/') !== false) {
    $base_path = '../';
} elseif (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
    $base_path = '../../';
}
?>

    </div> <!-- Cierre del contenedor principal del header -->

    <!-- Footer principal -->
    <footer class="mt-5 pt-5 pb-3" style="background-color: #d9d5cc; color: #352a19;">
        <div class="container">
            <div class="row g-4">
                <!-- Información de la empresa -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= $base_path ?>assets/img/logo.png" alt="Logo Technological Innovation" 
                             width="40" height="40" class="me-2">
                        <h5 class="fw-bold mb-0">Technological Innovation</h5>
                    </div>
                    <p class="mb-3">Tu tienda de confianza en tecnología y accesorios de última generación. Innovación al alcance de todos.</p>
                    
                    <!-- Redes sociales -->
                    <div class="d-flex gap-3">
                        <a href="https://wa.me/573222799496" target="_blank" rel="noopener noreferrer" 
                           class="text-decoration-none" style="color: #352a19;" title="WhatsApp">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                        <a href="mailto:info@technological-innovation.com" 
                           class="text-decoration-none" style="color: #352a19;" title="Email">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" 
                           class="text-decoration-none" style="color: #352a19;" title="Facebook">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" 
                           class="text-decoration-none" style="color: #352a19;" title="Instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Enlaces Rápidos</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?= $base_path ?>index.php" class="text-decoration-none" style="color: #352a19;">
                                <i class="fas fa-home me-1"></i>Inicio
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= $base_path ?>modulos/catalogo.php" class="text-decoration-none" style="color: #352a19;">
                                <i class="fas fa-store me-1"></i>Productos
                            </a>
                        </li>
                        <?php if (isset($_SESSION['id'])): ?>
                            <?php if ($_SESSION['rol'] === 'usuario'): ?>
                                <li class="mb-2">
                                    <a href="<?= $base_path ?>modulos/carrito.php" class="text-decoration-none" style="color: #352a19;">
                                        <i class="fas fa-shopping-cart me-1"></i>Mi Carrito
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="<?= $base_path ?>modulos/historial_pedidos.php" class="text-decoration-none" style="color: #352a19;">
                                        <i class="fas fa-history me-1"></i>Mis Pedidos
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="mb-2">
                                    <a href="<?= $base_path ?>modulos/admin/dashboard.php" class="text-decoration-none" style="color: #352a19;">
                                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="mb-2">
                                <a href="<?= $base_path ?>modulos/registro.php" class="text-decoration-none" style="color: #352a19;">
                                    <i class="fas fa-user-plus me-1"></i>Registro
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="<?= $base_path ?>modulos/login.php" class="text-decoration-none" style="color: #352a19;">
                                    <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Información de contacto -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-3">Contacto & Soporte</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="https://wa.me/573222799496" class="text-decoration-none" style="color: #352a19;">
                                +57 322 279 9496
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:info@technological-innovation.com" class="text-decoration-none" style="color: #352a19;">
                                info@technological-innovation.com
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Colombia</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock me-2"></i>
                            <span>Atención 24/7 por WhatsApp</span>
                        </li>
                    </ul>

                    <!-- Métodos de pago -->
                    <div class="mt-3">
                        <h6 class="fw-bold mb-2">Métodos de Pago</h6>
                        <div class="d-flex gap-2 align-items-center flex-wrap">
                            <i class="fab fa-cc-visa fa-2x" title="Visa"></i>
                            <i class="fab fa-cc-mastercard fa-2x" title="Mastercard"></i>
                            <i class="fas fa-money-bill-wave fa-2x" title="Efectivo"></i>
                            <i class="fab fa-paypal fa-2x" title="PayPal"></i>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: #352a19;">
            
            <!-- Copyright y enlaces legales -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-2 mb-md-0">
                        <i class="fas fa-copyright me-1"></i>
                        2025 <strong>Technological Innovation</strong>. Todos los derechos reservados.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex flex-wrap gap-3 justify-content-md-end justify-content-start">
                        <a href="<?= $base_path ?>modulos/politicas.php" class="text-decoration-none small" style="color: #352a19;">
                            Política de Privacidad
                        </a>
                        <a href="<?= $base_path ?>modulos/terminos.php" class="text-decoration-none small" style="color: #352a19;">
                            Términos de Servicio
                        </a>
                        <a href="<?= $base_path ?>modulos/envios.php" class="text-decoration-none small" style="color: #352a19;">
                            Política de Envíos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <small class="text-muted">
                        Desarrollado por <strong>Yonathan Gil</strong> | 
                        <i class="fas fa-shield-alt me-1"></i>Sitio seguro con certificado SSL |
                        <i class="fas fa-truck me-1"></i>Envíos a toda Colombia
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script personalizado para footer -->
    <script>
        // Año dinámico en copyright
        document.addEventListener('DOMContentLoaded', function() {
            const currentYear = new Date().getFullYear();
            const copyrightElements = document.querySelectorAll('footer p');
            copyrightElements.forEach(element => {
                if (element.textContent.includes('2025')) {
                    element.innerHTML = element.innerHTML.replace('2025', currentYear);
                }
            });
        });

        // Smooth scroll para enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>