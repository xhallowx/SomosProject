document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los formularios que tengan la clase confirm-form
    const forms = document.querySelectorAll("form.confirm-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            // Muestra una alerta de confirmación
            if (!confirm("You want to assign the task")) {
                event.preventDefault();
            }
        });
    });
});

window.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade'); // Aplica la clase fade después de 3 segundos

        // Espera 1 segundo (el tiempo de desvanecimiento) y luego elimina el elemento
        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); // Desvanecer después de 3 segundos
};