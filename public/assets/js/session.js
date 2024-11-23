document.getElementById('content_form').addEventListener('input', function () {
  console.log('hola estoy probando');
    const password = document.getElementById('password').value;
    const repeatPassword = document.getElementById('password_repeat').value;
    const errorDiv = document.getElementById('passwordError');

    if (password && repeatPassword) {
        if (password === repeatPassword) {
            errorDiv.style.display = 'none'; // Ocultar el error si coinciden
        } else {
            errorDiv.style.display = 'block'; // Mostrar el error si no coinciden
        }
    } else {
        errorDiv.style.display = 'none'; // No mostrar error si ambos están vacíos
    }
});

document.getElementById('content_form').addEventListener('submit', function (event) {
    const password = document.getElementById('password').value;
    const repeatPassword = document.getElementById('password_repeat').value;

    if (password !== repeatPassword) {
        event.preventDefault(); // Prevenir el envío del formulario
        alert('Las contraseñas no coinciden.');
    }
});

document.getElementById('password').addEventListener('input', function () {
    const password = this.value;
    const rules = {
        length: password.length >= 8,                    // Longitud mínima de 8 caracteres
        uppercase: /[A-Z]/.test(password),              // Al menos una letra mayúscula
        lowercase: /[a-z]/.test(password),              // Al menos una letra minúscula
        number: /\d/.test(password),                    // Al menos un número
        special: /[!@#$%^&*]/.test(password),           // Al menos un carácter especial
        noSpace: !/\s/.test(password)                   // No debe contener espacios
    };

    // Habilitar el botón solo si todas las reglas se cumplen
    const allValid = Object.values(rules).every(Boolean);
});