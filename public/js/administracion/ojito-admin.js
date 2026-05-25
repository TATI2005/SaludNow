document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function() {
        // Buscamos el input que está en el mismo contenedor que el icono
        const input = this.parentElement.querySelector('input');
        
        if (input.type === "password") {
            input.type = "text";
            // Cambiamos el icono a "ojo tachado"
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            // Volvemos al icono original
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
});