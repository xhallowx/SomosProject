indow.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade'); // Aplica la clase fade después de 3 segundos

        // Espera 1 segundo (el tiempo de desvanecimiento) y luego elimina el elemento
        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); // Desvanecer después de 3 segundos
};