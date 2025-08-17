<?php include("../includes/header.php"); ?>

<main class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container">
        <div class="login-avatar">
            🔐
        </div>
        
        <h2 class="login-title">Bienvenido</h2>
        <p class="login-subtitle">Inicia sesión para acceder a tu cuenta</p>
        
        <!-- Mensaje de error/éxito (si existe) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="login-message login-error">
                <strong>❌ Error:</strong> Credenciales incorrectas. Por favor, intenta nuevamente.
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="login-message login-success">
                <strong>✅ Éxito:</strong> Registro completado. Ahora puedes iniciar sesión.
            </div>
        <?php endif; ?>
        
        <form method="POST" action="loginController.php" class="login-form" id="loginForm">
            <div class="login-form-group">
                <input 
                    type="email" 
                    class="login-input" 
                    name="correo" 
                    id="correo"
                    placeholder="tu@email.com"
                    required
                >
                <label for="correo" class="login-floating-label">Correo Electrónico</label>
            </div>

            <div class="login-form-group">
                <input 
                    type="password" 
                    class="login-input" 
                    name="clave" 
                    id="clave"
                    placeholder="Tu contraseña"
                    required
                >
                <label for="clave" class="login-floating-label">Contraseña</label>
            </div>

            <div class="login-options">
                <label class="remember-me">
                    <div class="custom-checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <div class="checkmark"></div>
                    </div>
                    Recordarme
                </label>
                
                <a href="forgot-password.php" class="forgot-password">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit" class="btn-login">
                 Iniciar Sesión
            </button>
        </form>

        <div class="login-footer">
            <p>¿No tienes una cuenta?</p>
            <a href="registro.php" class="register-link">
                 Crear Cuenta Nueva
            </a>
        </div>
    </div>
</main>

<script>
// Validación en tiempo real para login
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const inputs = form.querySelectorAll('.login-input');
    const emailInput = document.getElementById('correo');
    const passwordInput = document.getElementById('clave');

    // Validación de campos
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateLoginField(this);
        });

        input.addEventListener('input', function() {
            // Remover estilos de error mientras escribe
            if (this.classList.contains('error')) {
                this.classList.remove('error');
            }
        });
    });

    function validateLoginField(field) {
        const value = field.value.trim();
        let isValid = true;

        field.classList.remove('error', 'success');

        if (field.name === 'correo') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (value && !emailRegex.test(value)) {
                isValid = false;
            }
        }

        if (field.name === 'clave') {
            if (value && value.length < 3) {
                isValid = false;
            }
        }

        if (value) {
            if (isValid) {
                field.classList.add('success');
            } else {
                field.classList.add('error');
            }
        }

        return isValid;
    }

    // Efecto de escritura en el título
    function typeWriter(element, text, speed = 100) {
        element.textContent = '';
        let i = 0;
        
        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        type();
    }


    // Efectos de teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (emailInput.value || passwordInput.value)) {
            // Efecto visual de "procesando"
            const submitBtn = form.querySelector('.btn-login');
            submitBtn.style.background = 'linear-gradient(135deg, #6c757d 0%, #495057 100%)';
            submitBtn.textContent = '⏳ Validando...';
            
            setTimeout(() => {
                form.submit();
            }, 500);
        }
    });

    // Validación antes de enviar
    form.addEventListener('submit', function(e) {
        let isFormValid = true;
        
        inputs.forEach(input => {
            if (!validateLoginField(input) && input.value.trim()) {
                isFormValid = false;
            }
        });

        // Verificar campos obligatorios
        if (!emailInput.value.trim() || !passwordInput.value.trim()) {
            isFormValid = false;
            
            if (!emailInput.value.trim()) {
                emailInput.classList.add('error');
            }
            if (!passwordInput.value.trim()) {
                passwordInput.classList.add('error');
            }
        }

        if (!isFormValid) {
            e.preventDefault();
            
            // Efecto de "shake" en el contenedor
            const container = document.querySelector('.login-container');
            container.style.animation = 'shake 0.5s ease-in-out';
            
            setTimeout(() => {
                container.style.animation = '';
            }, 500);
            
            // Mostrar mensaje de error temporal
            showTempMessage('Por favor, completa todos los campos correctamente', 'error');
        }
    });

    function showTempMessage(message, type) {
        // Crear mensaje temporal
        const messageDiv = document.createElement('div');
        messageDiv.className = `login-message login-${type}`;
        messageDiv.innerHTML = `<strong>${type === 'error' ? '❌ Error:' : '✅ Éxito:'}</strong> ${message}`;
        
        // Insertar antes del formulario
        const form = document.querySelector('.login-form');
        form.parentNode.insertBefore(messageDiv, form);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            messageDiv.remove();
        }, 3000);
    }
});

// Animación shake para errores
const shakeKeyframes = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
`;

// Agregar keyframes al documento
const style = document.createElement('style');
style.textContent = shakeKeyframes;
document.head.appendChild(style);
</script>
</body>

<?php include("../includes/footer.php"); ?>