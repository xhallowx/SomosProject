window.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade');

        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); 
};