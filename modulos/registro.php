<?php include("../includes/header.php"); ?>

<body class="register-page">
<main class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="register-container">
        <h2 class="register-title">Registro de Usuario</h2>
        
        <form method="POST" action="registroController.php" class="register-form" id="registerForm">
            <div class="form-group-enhanced">
                <input 
                    type="text" 
                    class="form-input" 
                    name="nombre" 
                    id="nombre"
                    placeholder="Ingresa tu nombre completo"
                    required
                >
                <label for="nombre" class="floating-label">Nombre Completo</label>
                <div class="validation-message" id="nombre-validation"></div>
            </div>

            <div class="form-group-enhanced">
                <input 
                    type="email" 
                    class="form-input" 
                    name="correo" 
                    id="correo"
                    placeholder="tu@email.com"
                    required
                >
                <label for="correo" class="floating-label">Correo Electrónico</label>
                <div class="validation-message" id="correo-validation"></div>
            </div>

            <div class="form-group-enhanced">
                <input 
                    type="password" 
                    class="form-input" 
                    name="clave" 
                    id="clave"
                    placeholder="Crea una contraseña segura"
                    required
                >
                <label for="clave" class="floating-label">Contraseña</label>
                <span class="form-icon">🔐</span>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <div class="validation-message" id="clave-validation"></div>
            </div>

            <div class="form-group-enhanced">
                <input 
                    type="tel" 
                    class="form-input" 
                    name="telefono" 
                    id="telefono"
                    placeholder="Número de teléfono (opcional)"
                >
                <label for="telefono" class="floating-label">Teléfono (Opcional)</label>
                <span class="form-icon">📱</span>
                <div class="validation-message" id="telefono-validation"></div>
            </div>

            <button type="submit" class="btn-register">
                 Crear Mi Cuenta 
            </button>
        </form>

        <div class="register-links">
            <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
        </div>
    </div>
</main>

<script>
// Validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const inputs = form.querySelectorAll('.form-input');
    const passwordInput = document.getElementById('clave');
    const strengthBar = document.getElementById('strengthBar');

    // Validación de contraseña
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        updatePasswordStrength(strength);
    });

    // Validación general de campos
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        return Math.min(strength, 4);
    }

    function updatePasswordStrength(strength) {
        const classes = ['strength-weak', 'strength-fair', 'strength-good', 'strength-strong'];
        strengthBar.className = 'password-strength-bar';
        
        if (strength > 0) {
            strengthBar.classList.add(classes[strength - 1]);
        }
    }

    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        const validationDiv = document.getElementById(fieldName + '-validation');
        
        let isValid = true;
        let message = '';

        switch(fieldName) {
            case 'nombre':
                if (value.length < 2) {
                    isValid = false;
                    message = 'El nombre debe tener al menos 2 caracteres';
                }
                break;
                
            case 'correo':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    message = 'Ingresa un correo electrónico válido';
                }
                break;
                
            case 'clave':
                if (value.length < 6) {
                    isValid = false;
                    message = 'La contraseña debe tener al menos 6 caracteres';
                }
                break;
                
            case 'telefono':
                if (value && !/^\+?[\d\s\-\(\)]{10,}$/.test(value)) {
                    isValid = false;
                    message = 'Formato de teléfono no válido';
                }
                break;
        }

        // Aplicar estilos de validación
        field.classList.remove('error', 'success');
        validationDiv.classList.remove('validation-error', 'validation-success');
        validationDiv.style.display = 'none';

        if (value && fieldName !== 'telefono') { // El teléfono es opcional
            if (isValid) {
                field.classList.add('success');
                validationDiv.textContent = '✓ Válido';
                validationDiv.classList.add('validation-success');
                validationDiv.style.display = 'block';
            } else {
                field.classList.add('error');
                validationDiv.textContent = message;
                validationDiv.classList.add('validation-error');
                validationDiv.style.display = 'block';
            }
        }

        return isValid;
    }

    // Validación antes de enviar
    form.addEventListener('submit', function(e) {
        let isFormValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input) && input.name !== 'telefono') {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            e.preventDefault();
            alert('Por favor, corrige los errores en el formulario antes de continuar.');
        }
    });
});
</script>
</body>

<?php include("../includes/footer.php"); ?>