document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los formularios que tengan la clase confirm-form
    const forms = document.querySelectorAll("form.confirm-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            // Muestra una alerta de confirmación
            if (!confirm("¿Do you want to continue?")) {
                event.preventDefault();
            }
        });
    });
});
